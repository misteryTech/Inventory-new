<?php
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $id = intval($_POST['id']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_price = htmlspecialchars($_POST['product_price']);
    $stock = htmlspecialchars($_POST['stock']); // Update this to hashed password if needed

    // Update query
    $query = "UPDATE products SET product_name = ?, product_price = ?, stock = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "siii", $product_name, $product_price, $stock, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('Product updated successfully.');
                window.location.href = '../product-list.php'; // Redirect back to the Product table
            </script>";
        } else {
            echo "<script>
                alert('Failed to update Product.');
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
