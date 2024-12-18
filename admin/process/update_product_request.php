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

    if ($request_id > 0 && !empty($batch_number)) {
        // Update the specific product's status
        $query = "
            UPDATE request_products 
            SET status = 'Approved', approved1 = '$session_user' 
            WHERE request_id = $request_id AND product_id = '$batch_number'
        ";

        if (mysqli_query($conn, $query)) {
            // Redirect back to the request page
            header("Location: ../view-requestpage.php?request_id=$request_id&username=" . urlencode($session_user) . "&success=Product approved successfully!");
            exit;
        } else {
            // Log the error for debugging (use file logging in production)
            error_log("MySQL Error: " . mysqli_error($conn));
            echo "<div class='alert alert-danger'>Error approving the product. Please try again later.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid input. Request ID or Batch Number is missing.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request method.</div>";
}
?>
