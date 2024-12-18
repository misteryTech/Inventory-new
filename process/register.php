<?php
include("connection.php");
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['password']);
    $role = "User";
    $Archive = "No";


    $sql = "INSERT INTO users (username, email, role, password, archive) VALUES ('$user', '$email', '$role', '$pass', '$Archive')";
    if ($conn->query($sql) === TRUE) {
        // JavaScript alert for success and redirection
        echo "<script>
                alert('Registration successful!');
                window.location.href = 'login.php'; // Redirect to login page
              </script>";
    } else {
        // JavaScript alert for error
        echo "<script>
                alert('Error: " . $conn->error . "');
                window.history.back(); // Go back to the form
              </script>";
    }
}

?>
