<?php
header('Content-Type: application/json'); // Ensure response is JSON
include("../connection.php");
// Get batch number from request
$batchNumber = isset($_GET['batch_number']) ? trim($_GET['batch_number']) : '';

if (empty($batchNumber)) {
    echo json_encode(["error" => "Batch number is required"]);
    exit;
}



// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM products WHERE batch_number = ? LIMIT 1");
$stmt->bind_param("s", $batchNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["exists" => true, "product" => $result->fetch_assoc()]);
} else {
    echo json_encode(["exists" => false]);
}

// Close connections
$stmt->close();
$conn->close();
?>
