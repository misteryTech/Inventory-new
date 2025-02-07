<?php
session_start();
include("../connection.php");

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?error=You must log in to approve requests.");
    exit;
}

$session_user = $_SESSION['username']; // Get the session user

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve_request'])) {
    // Validate and sanitize input
    $request_id = isset($_POST['request_id']) ? intval($_POST['request_id']) : 0;
    $batch_number = isset($_POST['batch_number']) ? mysqli_real_escape_string($conn, $_POST['batch_number']) : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
    $date_approved = date("Y-m-d H:i:s"); // Get the current timestamp

    if ($request_id > 0 && !empty($batch_number) && $quantity > 0) {
        // Update the specific product's status
        $query = "
            UPDATE request_products 
            SET status = 'Onprocess', approved1 = ? 
            WHERE request_id = ? AND product_id = ?
        ";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sis", $session_user, $request_id, $batch_number);

        if (mysqli_stmt_execute($stmt)) {
            // Fetch item name from the database
            $item_query = "SELECT product_name FROM products WHERE batch_number = ? LIMIT 1";
            $stmt_item = mysqli_prepare($conn, $item_query);
            mysqli_stmt_bind_param($stmt_item, "s", $batch_number);
            mysqli_stmt_execute($stmt_item);
            $result_item = mysqli_stmt_get_result($stmt_item);
            $row = mysqli_fetch_assoc($result_item);
            $item_name = $row ? $row['product_name'] : 'Unknown';

            // Insert into approved_products
            $insert_query = "
                INSERT INTO approved_products (batch_number, session_id, item_name, quantity, date_approved, print) 
                VALUES (?, ?, ?, ?, ?, 0)
            ";
            $stmt_insert = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($stmt_insert, "sssis", $batch_number, $request_id, $item_name, $quantity, $date_approved);

            if (mysqli_stmt_execute($stmt_insert)) {
                // Update product_requests table
                $update_query = "UPDATE product_requests SET status = 'Onprocess' WHERE request_id = ?";
                $stmt_update = mysqli_prepare($conn, $update_query);
                mysqli_stmt_bind_param($stmt_update, "i", $request_id);
                mysqli_stmt_execute($stmt_update);

                // Redirect back with success message
                header("Location: ../view-requestpage.php?request_id=$request_id&username=" . urlencode($session_user) . "&success=Product approved successfully!");
                exit;
            } else {
                error_log("MySQL Error (INSERT): " . mysqli_error($conn));
                echo "<div class='alert alert-danger'>Error inserting approved product. Please try again later.</div>";
            }
        } else {
            error_log("MySQL Error (UPDATE request_products): " . mysqli_error($conn));
            echo "<div class='alert alert-danger'>Error approving the product. Please try again later.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid input. Request ID, Batch Number, or Quantity is missing.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request method.</div>";
}
?>
