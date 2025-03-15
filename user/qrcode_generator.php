<?php
include '../admin/phpqrcode-master/qrlib.php'; // Include PHP QR Code library

if (!isset($_GET['data']) || empty($_GET['data'])) {
    die("<div class='error-message'>⚠ No release number provided.</div>");
}

$release_id = htmlspecialchars($_GET['data']); // Sanitize input
$qrCodePath = 'qrcode.png'; // File path for QR code
QRcode::png($release_id, $qrCodePath, QR_ECLEVEL_L, 10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Release QR Code</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        .qr-code {
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-print {
            background-color: #28a745;
            color: white;
        }
        .btn-close {
            background-color: #dc3545;
            color: white;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
        function closePage() {
            window.close();
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Release Number</h2>
        <p><strong><?php echo $release_id; ?></strong></p>
        <div class="qr-code">
            <img src="<?php echo $qrCodePath; ?>" alt="QR Code">
        </div>
        <button class="btn btn-print" onclick="printPage()">🖨 Print</button>
        <button class="btn btn-close" onclick="closePage()">❌ Close</button>
    </div>
</body>
</html>
