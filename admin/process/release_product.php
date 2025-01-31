<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input fields
    if (
        isset($_POST['request_id']) && is_numeric($_POST['request_id']) &&
        isset($_POST['batch_number']) && !empty($_POST['batch_number']) &&
        isset($_POST['quantity']) && is_numeric($_POST['quantity']) &&
        isset($_POST['session_id']) && is_numeric($_POST['session_id'])
    ) {
        $request_id = $_POST['request_id'];
        $batch_number = $_POST['batch_number']; // Identifies product in `products` table
        $quantity_to_release = $_POST['quantity'];
        $session_id = $_POST['session_id'];

        // Generate unique release form ID
        $releaseform = strtoupper(uniqid('RF', true));
        $release_date = date('Y-m-d H:i:s'); 

        // Start transaction to ensure data integrity
        mysqli_begin_transaction($conn);

        try {
            // Update request status to 'Released'
            $query = "UPDATE product_requests 
                      SET status = 'Released', release_form = ?, release_date = ? 
                      WHERE request_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssi', $releaseform, $release_date, $request_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Reduce product stock in `products` table
            $stock_query = "UPDATE products 
                            SET stock = stock - ? 
                            WHERE batch_number = ? AND stock >= ?";
            $stmt_stock = mysqli_prepare($conn, $stock_query);
            mysqli_stmt_bind_param($stmt_stock, 'isi', $quantity_to_release, $batch_number, $quantity_to_release);
            mysqli_stmt_execute($stmt_stock);

            // Check if stock was successfully updated
            if (mysqli_stmt_affected_rows($stmt_stock) > 0) {
                mysqli_stmt_close($stmt_stock);

                // Insert transfer record into `product_transfers`
                $transfer_query = "INSERT INTO product_transfer (user_id, batch_number, stock, release_date, request_id) 
                                   VALUES (?, ?, ?, ?, ?)";
                $stmt_transfer = mysqli_prepare($conn, $transfer_query);
                mysqli_stmt_bind_param($stmt_transfer, 'isisi', $session_id, $batch_number, $quantity_to_release, $release_date, $request_id);
                mysqli_stmt_execute($stmt_transfer);
                mysqli_stmt_close($stmt_transfer);

                // Commit transaction
                mysqli_commit($conn);
                echo "<script>
                        alert('Product release successful, stock updated, and transfer recorded.');
                        window.location.href = '../index.php'; 
                      </script>";
            } else {
                throw new Exception("Not enough stock available.");
            }
        } catch (Exception $e) {
            mysqli_rollback($conn); // Rollback if any error occurs
            echo "Error: " . $e->getMessage();
        }
    } else {
        header('Location: ../products.php?error=Invalid input');
        exit();
    }
} else {
    header('Location: ../products.php?error=Invalid request');
    exit();
}
?>
