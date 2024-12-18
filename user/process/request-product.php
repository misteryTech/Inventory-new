<?php
require '../connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedProducts = $_POST['selected_products'] ?? [];
    $quantities = $_POST['request_quantity'] ?? [];
    $comments = $_POST['comments'] ?? '';


    if (empty($selectedProducts)) {
        die('No products selected.');
    }

    foreach ($selectedProducts as $productId) {
        $quantity = $quantities[$productId];

        // Validate stock availability
        $productQuery = $conn->prepare("SELECT stock FROM products WHERE batch_number = ?");
        $productQuery->bind_param("s", $productId);
        $productQuery->execute();
        $productResult = $productQuery->get_result();

        if ($productResult->num_rows > 0) {
            $product = $productResult->fetch_assoc();
            if ($quantity > $product['stock']) {
                die("Requested quantity for product ID {$productId} exceeds available stock.");
            }

            // Insert into requests table
            $insertQuery = $conn->prepare("INSERT INTO requests (product_id, quantity, comments) VALUES (?, ?, ?)");
            $insertQuery->bind_param("sis", $productId, $quantity, $comments);
            $insertQuery->execute();
        }
    }

    echo "Request submitted successfully!";
    header("Location: ../index.php");
}
?>
