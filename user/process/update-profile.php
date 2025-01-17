<?php
require '../connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $User_id = trim($_POST['User_id']);
    $position = trim($_POST['position']);
    $department = trim($_POST['department']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $gender = trim($_POST['gender']);
    $dob = trim($_POST['dob']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $errors = [];

    // Validate required fields
    if (empty($position)) $errors[] = "Position is required.";
    if (empty($department)) $errors[] = "Department is required.";
    if (empty($firstName)) $errors[] = "First name is required.";
    if (empty($lastName)) $errors[] = "Last name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
    if (empty($mobile) || !preg_match('/^\d+$/', $mobile)) $errors[] = "A valid mobile number is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (empty($dob)) $errors[] = "Date of birth is required.";
    if (empty($address)) $errors[] = "Postcode is required.";
    if (empty($username)) $errors[] = "username is required.";
    if (empty($password)) $errors[] = "password is required.";

    // If there are errors, show alert and redirect back to the page
    if (!empty($errors)) {
        $errorMessage = implode("\n", $errors);
        echo "<script>alert('$errorMessage'); window.history.back();</script>";
    } else {
        // Update the database
        $updateQuery = $conn->prepare(
            "UPDATE users SET position=?, department=?, firstname=?, lastname=?, email=?, mobileno=?, gender=?, dob=?, `address`=?, username=?, `password`=? WHERE id=?"
        );
        $updateQuery->bind_param(
            "sssssssssssi",
            $position,
            $department,
            $firstName,
            $lastName,
            $email,
            $mobile,
            $gender,
            $dob,
            $address,
            $username,
            $password,
            $User_id
        );

        if ($updateQuery->execute()) {
            echo "<script>alert('Your profile has been successfully updated!'); window.location.href = '../profile-page.php';</script>";
        } else {
            echo "<div class='alert alert-danger'>Error updating profile: " . $conn->error . "</div>";
        }
    }
}
?>
