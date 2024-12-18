<?php
include ("../connection.php");
include('../phpqrcode-master/qrlib.php'); // Include the QR code library

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $batch_number = $_POST['batch_number'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $stock = $_POST['stock'];
    $supplier = $_POST['supplier'];
    $product_unit = $_POST['product_unit'];
    $condition = $_POST['condition'];
    $product_category = $_POST['product_category'];
    $reorder_point = $_POST['reorder_point'];
    $archive = "No";

    // Handle product image upload (only if a file is uploaded)
    $product_image = ""; // Default to empty if no image is uploaded

    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
        $target_dir = "uploads/"; // Directory to store the uploaded images
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is a valid image
        if (getimagesize($_FILES["product_image"]["tmp_name"]) === false) {
            echo "Sorry, the file is not an image.";
            $uploadOk = 0;
        }

        // Check file size (5MB max)
        if ($_FILES["product_image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats (JPG, JPEG, PNG, GIF)
        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if everything is okay
        if ($uploadOk === 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                $product_image = $target_file; // Store the file path if uploaded successfully
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Create QR code
    $qrCodeDir = 'qrcodes/'; // Directory where QR codes will be saved
    if (!is_dir($qrCodeDir)) {
        mkdir($qrCodeDir, 0755, true); // Create directory if it doesn't exist
    }

    $qrCodeFile = $qrCodeDir . $batch_number . '.png'; // Define file path for QR code
    QRcode::png($batch_number, $qrCodeFile, QR_ECLEVEL_L, 4); // Generate QR code

    // Prepare the SQL query to insert data into the products table
    $sql = "INSERT INTO products (batch_number, product_name, product_description, product_price, stock, supplier, product_unit, product_condition, product_category, product_image, archive, qr_code_path , reorder_point) 
            VALUES ('$batch_number', '$product_name', '$product_description', '$product_price', '$stock', '$supplier', '$product_unit', '$condition', '$product_category', '$product_image', '$archive', '$qrCodeFile', '$reorder_point')";

    // Execute the query and check if it was successful
    if ($conn->query($sql) === TRUE) {
        // Log the product registration in the product_registration_logs table
        $logQuery = "INSERT INTO product_registration_logs (product_id, action, quantity) 
                     VALUES (LAST_INSERT_ID(), 'Added', '$stock')";
        
        if ($conn->query($logQuery) === TRUE) {
            echo "<script>
                    alert('Product registered and log created successfully!');
                    window.location.href = '../register-product.php'; // Redirect back to the product registration page
                  </script>";
        } else {
            echo "Error logging product registration: " . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
