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
                SELECT RP.*, P.*
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
                    echo '<th>Batch Number</th>';
                    echo '<th>Condition</th>';
                    echo '<th>Quantity Requested</th>';
                    echo '<th>Status</th>';
                    echo '<th>Approved By';
                    echo '<th>Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Loop through and display the products
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = htmlspecialchars($row['status']);
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['batch_number']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['product_condition']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
                        echo '<td>' . ($status === 'Approved' ? "<span class='badge badge-success'>Approved</span>" : "<span class='badge badge-warning'>Pending</span>") . '</td>';
                        echo '<td>' . htmlspecialchars($row['approved1']) . '</td>';
                        echo '<td>';
                        // Form for each product's approval
                        if ($status !== 'Approved') {
                            echo '<form method="POST" action="process/update_product_request.php">';
                            echo '<input type="hidden" name="request_id" value="' . htmlspecialchars($request_id) . '">';
                            echo '<input type="hidden" name="batch_number" value="' . htmlspecialchars($row['batch_number']) . '">';
                            echo '<button type="submit" name="approve_request" class="btn btn-success btn-sm">Approve</button>';
                            echo '</form>';
                        } else {
                            echo '<button class="btn btn-secondary btn-sm" disabled>Approved</button>';
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
                    echo "<div class='alert '>No products found for this request.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Error fetching products: " . mysqli_error($conn) . "</div>";
            }
            ?>
        </div> <!-- main-panel -->
        <?php include("footer.php"); ?>
    </div> <!-- container-fluid -->
</body>
