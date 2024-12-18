<?php
include("header.php");

// Get the product IDs from the query string (if any)
if (isset($_GET['product_ids'])) {
    $productIds = explode(',', $_GET['product_ids']);
} else {
    // If no product IDs are passed, show an error or redirect
    echo "No products selected.";
    exit;
}

// Convert the product IDs to integers
$productIds = array_map('intval', $productIds);

// Query to fetch the products by their IDs
$productQuery = "SELECT id, batch_number, product_name, qr_code_path, product_price, stock FROM products WHERE id IN (" . implode(',', $productIds) . ") AND archive='No'";
$productResult = mysqli_query($conn, $productQuery);

if (mysqli_num_rows($productResult) > 0):
?>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        .product-card {
            width: 150px; /* Fixed width for the card */
            height: 150px; /* Fixed height for the card */
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            background-color: #f9f9f9;
            padding: 10px;
            box-sizing: border-box;
        }
        .product-card img {
            width: 100%;
            height: 100px; /* Fixed height for the image */
            object-fit: contain;
        }
        .card-body {
            padding: 5px;
            font-size: 0.9em;
            overflow: hidden;
        }
        .product-name {
            font-weight: bold;
            font-size: 1em;
            margin-top: 5px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
        
        /* Layout for 5 cards per row */
        .product-container .product-card {
            flex: 1 1 18%; /* Adjust for 5 cards per row */
            margin-bottom: 20px; /* Space between rows */
        }

        /* Responsive layout */
        @media (max-width: 1024px) {
            .product-container .product-card {
                flex: 1 1 20%; /* 4 cards per row on smaller screens */
            }
        }
        @media (max-width: 768px) {
            .product-container .product-card {
                flex: 1 1 30%; /* 3 cards per row on medium screens */
            }
        }
        @media (max-width: 480px) {
            .product-container .product-card {
                flex: 1 1 45%; /* 2 cards per row on smaller screens */
            }
        }
    </style>
</head>
<body>
    <h1>Selected Products</h1>
    <div class="product-container">
        <?php 
            // Loop through each product in the result set and display it in a card
            while ($row = mysqli_fetch_assoc($productResult)):
                // Only set product name and QR code if there's data
                $productName = htmlspecialchars($row['product_name']);
                $qrCodePath = 'process/' . $row['qr_code_path']; 
        ?>
            <div class="product-card">
                <img src="<?php echo $qrCodePath; ?>" alt="QR Code">
                <div class="card-body">
                    <p class="product-name"><?php echo $productName; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <script>
        // Print the page when it is loaded
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
<?php
else:
    echo "<p>No products found.</p>";
endif;

include("footer.php");
?>
