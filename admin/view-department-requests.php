<?php
include("header.php");

if (isset($_GET['department'])) {
    $department = mysqli_real_escape_string($conn, $_GET['department']);
}
?>
<body class="with-welcome-text">
    <div class="container-scroller">
        <?php include("topnav.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include("sidebar.php"); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <div id="printableArea">
                                <h4 class="card-title text-center"><?= htmlspecialchars($department) ?> Office</h4>
                                <p class="card-description text-center">List of User Requests product</p>
                       
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Position</th>
                                                    <th>Name</th>
                                                    <th>Reason</th>
                                                    <th>List of Item Requests</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT  U.*, PR.*
                                                          FROM product_requests AS PR 
                                                          INNER JOIN users AS U ON PR.session_id = U.id
                                                          WHERE PR.status = 'Pending' AND U.department = '$department'";
                                                $result = mysqli_query($conn, $query);

                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $position = htmlspecialchars($row['position']);
                                                        $Fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                                                        $comments = htmlspecialchars($row['comments']);
                                                        $requestId = $row['request_id'];

                                                        echo "<tr>";
                                                        echo "<td>{$position}</td>";
                                                        echo "<td>{$Fullname}</td>";
                                                        echo "<td>{$comments}</td>";
                                                        echo "<td>";
                                                        // Fetch products based on request_id
                                                        $productQuery = "SELECT P.product_name, RP.quantity
                                                                         FROM request_products AS RP
                                                                         INNER JOIN products AS P ON RP.product_id = P.batch_number
                                                                         WHERE RP.request_id = '$requestId'";
                                                        $productResult = mysqli_query($conn, $productQuery);

                                                        if (mysqli_num_rows($productResult) > 0) {
                                                            echo "<ul>";
                                                            while ($product = mysqli_fetch_assoc($productResult)) {
                                                                $productName = htmlspecialchars($product['product_name']);
                                                                $quantity = htmlspecialchars($product['quantity']);
                                                                echo "<li>{$productName} - Quantity: {$quantity}</li>";
                                                            }
                                                            echo "</ul>";
                                                        } else {
                                                            echo "<p>No products found for this request.</p>";
                                                        }
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4'>No requests found for this office.</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="margin-top: 50px;">
                                        <p><strong>Prepared By:</strong></p>
                                        <p style="text-align: right;"><strong>AMOR IRISH D. LOZANO, CPA/MBA</strong> <br> President </p>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3" onclick="printDiv('printableArea')"> <i class="icon-printer"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include("footer.php"); ?>
            </div>
        </div>
    </div>

    <script>
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            // Reload the page to restore original layout
            location.reload();
        }
    </script>

    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .table {
                width: 100%;
                border-collapse: collapse !important;
            }
            .table th, .table td {
                border: 1px solid black !important;
                padding: 8px !important;
            }
            h4, p {
                text-align: center;
            }
            .btn {
                display: none !important;
            }
            div[style*="text-align: right;"] {
                margin-top: 50px;
                float: right;
                margin-right: 50px;
            }
        }
    </style>
</body>
