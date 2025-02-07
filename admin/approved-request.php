<?php
include("header.php");
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
                                    <h4 class="card-title text-center"></h4>
                                    <p class="card-description text-center">List of User Approved Products</p>

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Date Approved</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include("connection.php"); // Ensure database connection is included

                                                $query = "SELECT date_approved, id, `print`, item_name, SUM(quantity) AS total_quantity 
                                                          FROM approved_products 
                                                          WHERE `print` = 0
                                                          GROUP BY item_name";

                                                $result = mysqli_query($conn, $query);
                                                
                                                if (mysqli_num_rows($result) > 0) {
                                                    $itemIds = []; // Store item IDs for updating later
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $item_name = htmlspecialchars($row['item_name']); 
                                                        $total_quantity = intval($row['total_quantity']);
                                                        $date_approved = htmlspecialchars($row['date_approved']);

                                                        echo "<tr>";
                                                        echo "<td>{$date_approved}</td>";
                                                        echo "<td>{$item_name}</td>";
                                                        echo "<td>{$total_quantity}</td>";
                                                        echo "</tr>";

                                                        // Collect IDs for updating
                                                        $itemIds[] = $row['id'];
                                                    }

                                                    // Store IDs in a hidden input for JavaScript
                                                    echo "<input type='hidden' id='itemIds' value='" . implode(",", $itemIds) . "'>";
                                                } else {
                                                    echo "<tr><td colspan='2'>No products found</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="margin-top: 50px;">
                                        <p>Prepared By:<strong> Charlotte Lapura</strong></p>
                                        <p style="text-align: right;"><strong>AMOR IRISH D. LOZANO, CPA/MBA</strong> <br> President </p>
                                    </div>
                                </div>
                                          <button class="btn btn-primary mt-3" onclick="getDateAndPrint()"> 
                                            <i class="icon-printer"></i> Print
                                        </button>

                            </div>
                        </div>
                    </div>
                </div>
                <?php include("footer.php"); ?>
            </div>
        </div>
    </div>

    <script>
        function getDateAndPrint() {
    var dateApproved = document.querySelector("tbody tr:first-child td:first-child").innerText; // Get the first row's date
    if (dateApproved) {
        printAndUpdate(dateApproved);
    } else {
        alert("No approved products found.");
    }
}

function printAndUpdate(dateApproved) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process/update_print_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Debugging
            printDiv('printableArea');
        }
    };

    xhr.send("date_approved=" + encodeURIComponent(dateApproved));
}

function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

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
