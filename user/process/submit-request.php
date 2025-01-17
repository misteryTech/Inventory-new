<?php
session_start();

include("../connection.php");  // Your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the session ID (this will be used for guests)
    $session_id =  $_SESSION['user_id'];
    $status = "Pending";

    // Optional Comments
    $comments = isset($_POST['comments']) ? mysqli_real_escape_string($conn, $_POST['comments']) : '';

    // Insert the product request into the product_requests table
    $query = "INSERT INTO product_requests (session_id, comments, status) VALUES ('$session_id', '$comments', '$status')";
    if (mysqli_query($conn, $query)) {
        $request_id = mysqli_insert_id($conn);  // Get the ID of the newly inserted request

        // Insert each requested product into the request_products table
        $success = true;  // Initialize success flag

        if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
            foreach ($_POST['selected_products'] as $product_id) {
                $quantity = isset($_POST['request_quantity'][$product_id]) ? $_POST['request_quantity'][$product_id] : 0;

                // Validate quantity
                if ($quantity > 0) {
                    $query = "INSERT INTO request_products (request_id, product_id, quantity) 
                              VALUES ('$request_id', '$product_id', '$quantity')";
                    if (!mysqli_query($conn, $query)) {
                        // Handle query error
                        echo "Error: " . mysqli_error($conn);
                        $success = false;  // Set success to false if any query fails
                    }
                }
            }

            // Check if all product insertions were successful
            if ($success) {
                // Success: All products added
                echo "<script>alert('Your request has been submitted successfully!'); window.location.href = '../index.php';</script>";
            } else {
                // Error during product insertion
                echo "<script>alert('An error occurred while adding products to your request. Please try again.'); window.history.back();</script>";
            }
        } else {
            // No products selected
            echo "<script>alert('No products selected. Please select at least one product.'); window.history.back();</script>";
        }
    } else {
        // Error inserting request
        echo "<script>alert('An error occurred while submitting your request: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
}
?>
