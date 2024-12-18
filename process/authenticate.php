<?php
include ("connection.php");


// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $conn->real_escape_string($_POST['identifier']); // Can be username or email
    $password = $_POST['password'];

    // Query to check for username or email
    $sql = "SELECT * FROM users WHERE email = '$identifier' OR username = '$identifier'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify plain password
        if ($password === $user['password']) {
            // Start session and store user info
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Role-based redirection
            if ($user['role'] === 'Admin') {
                echo "<script>
                        alert('Welcome, Admin!');
                        window.location.href = '../admin/index.php'; // Redirect to admin dashboard
                      </script>";
            } elseif ($user['role'] === 'User') {
                echo "<script>
                        alert('Welcome, User!');
                        window.location.href = '../user/index.php'; // Redirect to user dashboard
                      </script>";
            } else {
                echo "<script>
                        alert('Unknown role!');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Incorrect password!');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('No user found with this username or email!');
                window.history.back();
              </script>";
    }
    $conn->close();
}
?>
