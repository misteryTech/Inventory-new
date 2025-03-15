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
                                <h4 class="card-title">Department Request</h4>
                                <p class="card-description">List of Departments Requested.</p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Department</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT DISTINCT U.department, PR.*
                                                      FROM product_requests AS PR 
                                                      INNER JOIN users AS U ON PR.session_id = U.id
                                                
                                                      GROUP BY U.department";
                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $department = $row['department'];
                                                    $requestId = $row['request_id'];
                                                    
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($department) . "</td>";
                                                    echo "<td>
                                                           <a href='view-department-requests.php?department=$department' class='btn btn-secondary btn-sm mb-3'>View Product Requests</a>
                                                          </td>";
                                                    echo "</tr>";

                                             
                                                }
                                            } else {
                                                echo "<tr><td colspan='2'>No departments found</td></tr>";
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
