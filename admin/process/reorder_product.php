<?php
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $batch_number = $_POST['batch_number'];
    $reorder_quantity = $_POST['reorder_quantity'];
    $reorder_notes = $_POST['reorder_notes'];
    $created_at = date('Y-m-d H:i:s'); // Get current timestamp

    // Fetch current stocks from the database based on batch_number
    $stock_query = "SELECT stock FROM products WHERE batch_number = ?";
    $stock_stmt = mysqli_prepare($conn, $stock_query);
    if ($stock_stmt) {
        mysqli_stmt_bind_param($stock_stmt, "s", $batch_number);
        mysqli_stmt_execute($stock_stmt);
        mysqli_stmt_bind_result($stock_stmt, $existing_stocks);
        mysqli_stmt_fetch($stock_stmt);
        mysqli_stmt_close($stock_stmt);
    }

    // Ensure existing_stocks has a valid value
    $existing_stocks = $existing_stocks ?? 0;

    // Calculate new stock value
    $new_stocks = $existing_stocks + $reorder_quantity;

    // Update query to update stock information based on batch_number
    $query = "UPDATE products SET stock = ? WHERE batch_number = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "is", $new_stocks, $batch_number);
        if (mysqli_stmt_execute($stmt)) {
            // Insert log entry into product_registration_logs
            $log_query = "INSERT INTO product_registration_logs (product_id, action, quantity, created_at) VALUES (?, 'add stocks', ?, ?)";
            $log_stmt = mysqli_prepare($conn, $log_query);
            if ($log_stmt) {
                mysqli_stmt_bind_param($log_stmt, "sis", $batch_number, $reorder_quantity, $created_at);
                mysqli_stmt_execute($log_stmt);
                mysqli_stmt_close($log_stmt);
            }
            
            echo "<script>
                alert('Stock updated successfully based on batch number.');
                window.location.href = '../index.php'; // Redirect back to the product table
            </script>";
        } else {
            echo "<script>
                alert('Failed to update product stock.');
                window.history.back(); // Go back to the previous page
            </script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
            alert('Database error.');
            window.history.back();
        </script>";
    }

    mysqli_close($conn);
}
?>
