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
                                            $query = "SELECT * FROM users WHERE archive='No'"; // Include 'id' for unique identification
                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $userId = $row['id'];
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                                    echo "<td>
                                                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal$userId'>Edit</button>
                                                        <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#archiveModal$userId'>Archive</button>
                                                    </td>";
                                                    echo "</tr>";

                                                    // Edit Modal
                                                    echo "<div class='modal fade' id='editModal$userId' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                                                  <div class='modal-dialog modal-xl'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title' id='editModalLabel'>Edit User</h5>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <form action='process/edit_user.php' method='POST'>
                                                            <div class='modal-body'>
                                                                <input type='hidden' name='id' value='$userId'>
                                                                <div class='row'>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='firstname' class='form-label'>Firstname</label>
                                                                            <input type='text' class='form-control' name='firstname' value='" . htmlspecialchars($row['firstname']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='lastname' class='form-label'>Lastname</label>
                                                                            <input type='text' class='form-control' name='lastname' value='" . htmlspecialchars($row['lastname']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                                                
                                                                <div class='row'>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='position' class='form-label'>Position</label>
                                                                            <input type='text' class='form-control' name='position' value='" . htmlspecialchars($row['position']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='department' class='form-label'>Department</label>
                                                                            <input type='text' class='form-control' name='department' value='" . htmlspecialchars($row['department']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                                                
                                                                <div class='row'>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='gender' class='form-label'>Gender</label>
                                                                            <select name='gender' class='form-select' required>
                                                                                <option value='Male' " . ($row['gender'] == 'Male' ? 'selected' : '') . ">Male</option>
                                                                                <option value='Female' " . ($row['gender'] == 'Female' ? 'selected' : '') . ">Female</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='dob' class='form-label'>Date Of Birth</label>
                                                                            <input type='text' class='form-control' name='dob' value='" . htmlspecialchars($row['dob']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                                                
                                                                <div class='row'>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='email' class='form-label'>Email</label>
                                                                            <input type='email' class='form-control' name='email' value='" . htmlspecialchars($row['email']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='mobileno' class='form-label'>Mobile No.</label>
                                                                            <input type='text' class='form-control' name='mobileno' value='" . htmlspecialchars($row['mobileno']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                                                
                                                                <div class='row'>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='username' class='form-label'>Username</label>
                                                                            <input type='text' class='form-control' name='username' value='" . htmlspecialchars($row['username']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class='col-md-6'>
                                                                        <div class='mb-3'>
                                                                            <label for='password' class='form-label'>Password</label>
                                                                            <input type='password' class='form-control' name='password' value='" . htmlspecialchars($row['password']) . "' required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                                                
                                                                <div class='row'>
                                                                    <div class='col-md-12'>
                                                                        <div class='mb-3'>
                                                                            <label for='address' class='form-label'>Address</label>
                                                                            <input type='text' class='form-control' name='address' value='" . htmlspecialchars($row['address']) . "' required>
                                                                        </div>
                                                                    </div>
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
