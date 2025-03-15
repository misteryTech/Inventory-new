<?php
include("connection.php"); // Include database connection

if (isset($_GET['q'])) {
    $searchQuery = trim($_GET['q']);
    
    // Prepare SQL to fetch matching requests
    $stmt = $conn->prepare("SELECT RP.*, PR.*, U.*
                            FROM request_products AS RP
                            INNER JOIN product_requests AS PR ON PR.request_id = RP.request_id
                            INNER JOIN users AS U ON U.id = PR.session_id
                            WHERE RP.product_id LIKE ? 
                            ORDER BY RP.product_id ASC");
    $searchParam = "%" . $searchQuery . "%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* ✅ Page Styling */
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f8f9fa;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 100%;
        }

        /* ✅ Table Styling */
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
            padding: 10px;
        }

        .table th {
            background-color: #343a40;
            color: white;
        }

        /* ✅ Print Layout (Long Bond Paper: 8.5 x 13 inches) */
        @media print {
            body {
                font-size: 12px;
            }

            .container {
                width: 8.5in;
                height: 13in;
                margin: auto;
            }

            .btn-container {
                display: none; /* Hide buttons */
            }

            .table {
                width: 100%;
                table-layout: fixed;
            }

            .table th, .table td {
                font-size: 12px;
                word-wrap: break-word;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- ✅ Buttons (Hidden on Print) -->
    <div class="btn-container d-flex justify-content-between mb-3">
        <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
        <a href="index.php" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <h2 class="text-center mb-4">Search Results for "<strong><?= htmlspecialchars($searchQuery) ?></strong>"</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?></td>
                            <td><?= htmlspecialchars($row['department']) ?></td>
                            <td><?= htmlspecialchars($row['position']) ?></td>
                            <td><?= htmlspecialchars($row['product_id']) ?></td>
                            <td><?= htmlspecialchars($row['quantity']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td><?= htmlspecialchars($row['remarks']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            No products found for "<strong><?= htmlspecialchars($searchQuery) ?></strong>"
        </div>
    <?php endif; ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
