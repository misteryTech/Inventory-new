<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $unit = $_POST['unit'];
    $query = "INSERT INTO unit (unit) VALUES ('$unit')";
    
    if (mysqli_query($conn, $query)) {
        echo "Unit added successfully!";
    } else {
        echo "Error adding unit!";
    }
}
?>
