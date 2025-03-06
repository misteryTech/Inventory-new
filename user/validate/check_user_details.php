<?php
session_start();


include '../connection.php'; // Database connection

$user_id = $_SESSION['user_id'];
$response = ['complete' => false];

if ($user_id) {
    $query = "SELECT firstname, lastname, email, mobileno FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // Check if all required fields are filled
    if (!empty($result['firstname']) && !empty($result['lastname']) && !empty($result['email']) && !empty($result['mobileno'])) {
        $response['complete'] = true;
    }
}

echo json_encode($response);
?>
