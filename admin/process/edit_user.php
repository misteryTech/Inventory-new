<?php
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $id = intval($_POST['id']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']); // Update this to hashed password if needed

    // Update query
    $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $password, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('User updated successfully.');
                window.location.href = '../user-list.php'; // Redirect back to the user table
            </script>";
        } else {
            echo "<script>
                alert('Failed to update user.');
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
