<?php
include("../connection.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Update query to set the status as archived
    $query = "UPDATE users SET archive = 'Yes' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('User archived successfully.');
                window.location.href = '../user-list.php'; // Redirect back to the user table
            </script>";
        } else {
            echo "<script>
                alert('Failed to archive user.');
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
