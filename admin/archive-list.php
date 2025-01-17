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
                                <h4 class="card-title">User Table</h4>
                                <p class="card-description"> Manage users with Edit and Archive options. </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> Username </th>
                                                <th> Email </th>
                                                <th> Password </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT id, username, email, password FROM users WHERE archive='Yes'"; // Include 'id' for unique identification
                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $userId = $row['id'];
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                                    echo "<td>
                                         
                                                        <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#RestoreModal$userId'>Restore</button>
                                                    </td>";
                                                    echo "</tr>";

                                                    // Edit Modal
                                                    // echo "<div class='modal fade' id='editModal$userId' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                                                    //     <div class='modal-dialog'>
                                                    //         <div class='modal-content'>
                                                    //             <div class='modal-header'>
                                                    //                 <h5 class='modal-title' id='editModalLabel'>Edit User</h5>
                                                    //                 <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    //             </div>
                                                    //             <form action='process/edit_user.php' method='POST'>
                                                    //                 <div class='modal-body'>
                                                    //                     <input type='hidden' name='id' value='$userId'>
                                                    //                     <div class='mb-3'>
                                                    //                         <label for='username' class='form-label'>Username</label>
                                                    //                         <input type='text' class='form-control' name='username' value='" . htmlspecialchars($row['username']) . "' required>
                                                    //                     </div>
                                                    //                     <div class='mb-3'>
                                                    //                         <label for='email' class='form-label'>Email</label>
                                                    //                         <input type='email' class='form-control' name='email' value='" . htmlspecialchars($row['email']) . "' required>
                                                    //                     </div>
                                                    //                     <div class='mb-3'>
                                                    //                         <label for='password' class='form-label'>Password</label>
                                                    //                         <input type='text' class='form-control' name='password' value='" . htmlspecialchars($row['password']) . "' required>
                                                    //                     </div>
                                                    //                 </div>
                                                    //                 <div class='modal-footer'>
                                                    //                     <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                    //                     <button type='submit' class='btn btn-primary'>Save Changes</button>
                                                    //                 </div>
                                                    //             </form>
                                                    //         </div>
                                                    //     </div>
                                                    // </div>";

                                                    // Archive Modal
                                                    echo "<div class='modal fade' id='RestoreModal$userId' tabindex='-1' aria-labelledby='restoreModalLabel' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h5 class='modal-title' id='restoreModalLabel'>Archive User</h5>
                                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    Are you sure you want to restore this user?
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                                                    <a href='process/restore_user.php?id=$userId' class='btn btn-success'>Restore</a>
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
