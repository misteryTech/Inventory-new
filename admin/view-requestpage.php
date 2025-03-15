<?php
include("header.php");

$session_user = $_SESSION['username']; // Get the username from the session
?>
<body class="with-welcome-text">
    <div class="container-scroller">
        <?php include("topnav.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php
            include("sidebar.php");

            // Validate request_id and username in the GET parameters
            if (isset($_GET['request_id']) && isset($_GET['username'])) {
                $request_id = intval($_GET['request_id']);
                $username = htmlspecialchars($_GET['username']); // Sanitize username
            } else {
                echo "<div class='alert alert-danger'>Request ID or Username not provided.</div>";
                exit;
            }

            // Fetch products associated with the request_id
            $query = "
                SELECT RP.*, P.* , RP.status AS RP_status
                FROM request_products AS RP
                INNER JOIN products AS P ON RP.product_id = P.batch_number
                WHERE RP.request_id = $request_id
            ";

            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="row flex-grow">';
                    echo '<div class="col-12 grid-margin stretch-card">';
                    echo '<div class="card card-rounded">';
                    echo '<div class="card-body">';
                    echo '<div class="d-sm-flex justify-content-between align-items-start">';
                    echo '<div><h4 class="card-title card-title-dash">' . $username . '</h4> List of Requests </div>';
                    echo '</div>';
                    echo '<div class="table-responsive mt-1">';
                    echo '<table class="table select-table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Product Name</th>';
                    echo '<th>Product ID</th>';
                    echo '<th>Condition</th>';
                    echo '<th>Quantity Requested</th>';
                    echo '<th>Status</th>';
                    echo '<th>Manage By</th>';
                    echo '<th>Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Loop through and display the products
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = htmlspecialchars($row['status']);
                        $RP_status = htmlspecialchars($row['RP_status']);


                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['batch_number']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['product_condition']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
                        echo '<td>';
                        if ($RP_status === 'Declined') {
                            echo "<span class='badge badge-danger'>Declined</span>";
                        } elseif ($RP_status === 'Onprocess') {
                            echo "<span class='badge badge-warning'>Onprocess</span>";
                        } 
                        else {
                            echo "<span class='badge badge-primary'>Pending</span>";
                        }
                        echo '</td>';
                        echo '<td>' . htmlspecialchars($row['approved1']) . '</td>';
                        echo '<td>';

                        // Approve Button
                        if ($status !== 'Onprocess' && $status !== 'Declined') {
                            echo '<form method="POST" action="process/update_product_request.php" style="display:inline-block; margin-right: 5px;">';
                            echo '<input type="hidden" name="request_id" value="' . htmlspecialchars($request_id) . '">';
                            echo '<input type="hidden" name="batch_number" value="' . htmlspecialchars($row['batch_number']) . '">';
                            echo '<input type="hidden" name="quantity" value="' . htmlspecialchars($row['quantity']) . '">';
                            echo '<button type="submit" name="approve_request" class="btn btn-success btn-sm">Approve</button>';
                            echo '</form>';
                        }

                        // Decline Button
                        if ($status !== 'Declined' && $status !== 'Onprocess') {
                            echo '<form method="POST" action="process/decline_product_request.php" style="display:inline-block;">';
                            echo '<input type="hidden" name="request_id" value="' . htmlspecialchars($request_id) . '">';
                            echo '<input type="hidden" name="batch_number" value="' . htmlspecialchars($row['batch_number']) . '">';
                            echo '<button type="submit" name="decline_request" class="btn btn-danger btn-sm">Decline</button>';
                            echo '</form>';
                        }

                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>'; // table-responsive
                    echo '</div>'; // card-body
                    echo '</div>'; // card
                    echo '</div>'; // col-12
                    echo '</div>'; // row flex-grow
                } else {
                    echo "<div class='alert alert-info'>No products found for this request.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Error fetching products: " . mysqli_error($conn) . "</div>";
            }
            ?>
        </div> <!-- main-panel -->
        <?php include("footer.php"); ?>
    </div> <!-- container-fluid -->
</body>
