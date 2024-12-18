<?php
// Include the database connection file
include("../connection.php");



if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Retrieve product ID from the query string
    $productId = intval($_GET['id']);

    // SQL query to set the product as archived
    $query = "UPDATE products SET archive = 'No' WHERE id = '$productId'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Product restore successfully.');
                window.location.href = '../archive-product.php'; // Redirect back to the Product table
            </script>";


    } else {
        // Handle query error
        echo "Error archiving product: " . mysqli_error($conn);
    }
} else {
    // Redirect if no valid ID is provided
    header('Location: ../products.php?error=Invalid product ID');
    exit();
}
?>
