<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];
    $query = "INSERT INTO category (category_name) VALUES ('$category_name')";
    
    if (mysqli_query($conn, $query)) {
        echo "Category added successfully!";
    } else {
        echo "Error adding unit!";
    }
}
?>
