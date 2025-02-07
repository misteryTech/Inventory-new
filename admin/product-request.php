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
                                <h4 class="card-title">Product Request</h4>
               
                                
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> Username </th>
                                                <th> Request Date </th>
                                                <th> Status </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            $query = "SELECT PR.*, U.*      
                                            FROM product_requests AS PR
                                             JOIN users AS U ON U.id = PR.session_id WHERE status='Pending' ORDER BY request_date DESC";
                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $request_id = $row['request_id'];
                                                    $username = $row['username'];
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['request_date']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                                    echo "<td>
                                       
                                                        <a href='view-requestpage.php?request_id=$request_id&username=$username' class='btn btn-secondary btn-sm mb-3'>View Product Requests</a>

                                     
                                                    </td>";
                                                    echo "</tr>";

                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No users found</td></tr>";
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
</body>
