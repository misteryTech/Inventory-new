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
                                <h4 class="card-title">Reports</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="reportTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Category</th>
                                       
                                                <th>Request Date</th>
                                                <th>Approved By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_report = "SELECT PR.*, U.firstname, U.lastname, U.department, 
                                                            C.category_name, PR.request_id, U.id AS UserId, RP.approved1
                                                            FROM product_requests AS PR
                                                            INNER JOIN users AS U ON U.id = PR.session_id 
                                                            INNER JOIN request_products AS RP ON RP.request_id = PR.request_id 
                                                            INNER JOIN products AS P ON P.batch_number = RP.product_id 
                                                            INNER JOIN category AS C ON C.id = P.product_category 
                                                            GROUP BY PR.request_id"; 

                                            $result = mysqli_query($conn, $query_report);

                                            if(mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $requestId = $row['request_id'];
                                                    $fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                                                    $department = htmlspecialchars($row['department']);
                                                    $category_name = htmlspecialchars($row['category_name']);
                                                    $request_date = date("F d, Y ", strtotime($row['request_date']));
                                                    $approved1 = htmlspecialchars($row['approved1']);

                                                    echo "<tr>";
                                                    echo "<td>{$fullname}</td>";
                                                    echo "<td>{$department}</td>";
                                                    echo "<td>{$category_name}</td>";
                                                    // echo "<td ><div class='wrap-text'>"; // ✅ Add wrapping div

                                                    // // Fetch products based on request_id
                                                    // $productQuery = "SELECT P.product_name, RP.quantity, RP.status AS RP_status
                                                    //                  FROM request_products AS RP
                                                    //                  INNER JOIN products AS P ON RP.product_id = P.batch_number
                                                    //                  WHERE RP.request_id = ?";
                                                    // $stmt = $conn->prepare($productQuery);
                                                    // $stmt->bind_param("i", $requestId);
                                                    // $stmt->execute();
                                                    // $productResult = $stmt->get_result();

                                                    // if ($productResult->num_rows > 0) {
                                                    //     echo "<ul>";
                                                    //     while ($product = $productResult->fetch_assoc()) {
                                                    //         $productName = htmlspecialchars($product['product_name']);
                                                    //         $RP_status = htmlspecialchars($product['RP_status']);
                                                    //         $quantity = htmlspecialchars($product['quantity']);
                                                    //         echo "<li>{$productName} - Qty: {$quantity}, Status: {$RP_status}</li>";
                                                    //     }
                                                    //     echo "</ul>";
                                                    // } else {
                                                    //     echo "<p>No products found.</p>";
                                                    // }
                                                    // echo "</div></td>"; // ✅ Close wrapping div

                                                    echo "<td>$request_date</td>";
                                                    echo "<td>$approved1</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>No Data found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include("footer.php"); ?>
            </div>
        </div>
    </div>

<!-- ✅ Add CSS for Better Printing & Word Wrapping -->
<style>
/* ✅ Ensure text wraps correctly */
.wrap-text {
    max-width: 180px;
    word-wrap: break-word;
    white-space: normal;
    overflow-wrap: break-word;
}

/* ✅ Hide 'Item Request' only when printing */
@media print {
    body {
        font-size: 10px;
    }

    #reportTable th:nth-child(4), 
    #reportTable td:nth-child(4) {
        display: none; /* ✅ Hide "Item Request" in print */
    }

    #reportTable {
        width: 100%;
        table-layout: fixed;
    }

    #reportTable td {
        word-wrap: break-word;
        white-space: normal;
    }
}

</style>

<!-- ✅ Include DataTables and Print Button -->
<script>$(document).ready(function() {
$('#reportTable').DataTable({
    "pageLength": 10,
    "responsive": true,
    "autoWidth": false,
    "dom": 'Bfrtip',
    "buttons": [
        {
            extend: 'print',
            text: '<i class="fa fa-print"></i> Print',
            title: 'Report',
            customize: function (win) {
                $(win.document.body).css('font-size', '10px'); // Reduce font size
                $(win.document.body).find('table')
                    .addClass('display')
                    .css('font-size', '9px')
                    .css('table-layout', 'fixed'); // Prevent stretching

                // Add Prepared by and Noted by side by side
                $(win.document.body).append(`
                    <div style="margin-top:50px;">
                        <table style="width:100%; font-size:12px; border-collapse:collapse;">
                            <tr>
                                <td style="width:50%; text-align:left;">
                                    <strong>Prepared by:</strong><br>
                                    <u><h3>Charlotte Lapura </h3> </u><br>
                                </td>
                                <td style="width:50%; text-align:right;">
                                    <strong>Noted by:</strong><br>
                                  <u><h3>Amor Irish D. Lozano</h3></u><br>
                                     <h5>CPA, MBA <h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                `);
            }
        }
    ]
});
});


</script>
