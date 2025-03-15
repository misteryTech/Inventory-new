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
                                                    <th>Status</th>
                                                    <th>List of Item Requests</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT  U.*, PR.*
                                                          FROM product_requests AS PR 
                                                          INNER JOIN users AS U ON PR.session_id = U.id
                                                          WHERE U.department = '$department'";
                                                $result = mysqli_query($conn, $query);

                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $position = htmlspecialchars($row['position']);
                                                        $Fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                                                        $comments = htmlspecialchars($row['comments']);
                                                        $status = htmlspecialchars($row['status']);
                                                        $requestId = $row['request_id'];

                                                        echo "<tr>";
                                                        echo "<td>{$position}</td>";
                                                        echo "<td>{$Fullname}</td>";
                                                     
                                                        echo "<td>{$comments}</td>";
                                                        echo "<td>{$status}</td>";
                                                        echo "<td>";
                                                        // Fetch products based on request_id
                                                        $productQuery = "SELECT P.product_name, RP.quantity, RP.status AS RP_status
                                                                         FROM request_products AS RP
                                                                         INNER JOIN products AS P ON RP.product_id = P.batch_number
                                                                         WHERE RP.request_id = '$requestId'";
                                                        $productResult = mysqli_query($conn, $productQuery);

                                                        if (mysqli_num_rows($productResult) > 0) {
                                                            echo "<ul>";
                                                            while ($product = mysqli_fetch_assoc($productResult)) {
                                                                $productName = htmlspecialchars($product['product_name']);
                                                                $RP_status = htmlspecialchars($product['RP_status']);
                                                                $quantity = htmlspecialchars($product['quantity']);
                                                                echo "<li>{$productName} - Quantity: {$quantity} <br> Status: {$RP_status}</li>";
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
                                  
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <?php include("footer.php"); ?>
            </div>
        </div>
    </div>

</body>
