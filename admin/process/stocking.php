<?php
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $id = intval($_POST['id']);
    $instock = htmlspecialchars($_POST['instock']);
    $stockAdded = htmlspecialchars($_POST['stockAdded']);

        $result  = $instock + $stockAdded;

        
    // Update query
    $query = "UPDATE products SET stock = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $result, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('Product stocks successfully.');
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
