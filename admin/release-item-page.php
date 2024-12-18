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
                                <h4 class="card-title">Release Page</h4>
                                <p class="card-description"> List of item to release. </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> Session ID </th>
                                                <th> Description </th>
                                                <th> Status </th>
                                                <th> Release ID </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT request_id, session_id, comments, status, release_form FROM product_requests "; // Include 'id' for unique identification
                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $userId = $row['request_id'];
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['session_id']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['comments']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['release_form']) . "</td>";
                                                    echo "<td>
                                                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal$userId'>Release Item</button>
                                                      
                                                    </td>";
                                                    echo "</tr>";

                                                    // Edit Modal
                                                    echo "<div class='modal fade' id='editModal$userId' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h5 class='modal-title' id='editModalLabel'>Edit User</h5>
                                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                </div>
                                                                <form action='process/edit_user.php' method='POST'>
                                                                    <div class='modal-body'>
                                                                        <input type='hidden' name='id' value='$userId'>
                                                                        <div class='mb-3'>
                                                                            <label for='username' class='form-label'>Username</label>
                                                                            <input type='text' class='form-control' name='username' value='" . htmlspecialchars($row['session_id']) . "' required>
                                                                        </div>
                                                                        <div class='mb-3'>
                                                                            <label for='email' class='form-label'>Email</label>
                                                                            <input type='email' class='form-control' name='email' value='" . htmlspecialchars($row['comments']) . "' required>
                                                                        </div>
                                                                        <div class='mb-3'>
                                                                            <label for='password' class='form-label'>Password</label>
                                                                            <input type='text' class='form-control' name='password' value='" . htmlspecialchars($row['release_form']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class='modal-footer'>
                                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                                        <button type='submit' class='btn btn-primary'>Save Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>";

                                                    // Archive Modal
                                                    echo "<div class='modal fade' id='archiveModal$userId' tabindex='-1' aria-labelledby='archiveModalLabel' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h5 class='modal-title' id='archiveModalLabel'>Archive User</h5>
                                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    Are you sure you want to archive this user?
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                                                    <a href='process/archive_user.php?id=$userId' class='btn btn-danger'>Archive</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";
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
