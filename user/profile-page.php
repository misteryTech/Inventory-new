        <?php
        include("header.php");
        ?>
        <style>
                    /* General styles for the dropdown */
    select.form-select {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 8px;
        width: 100%;
        transition: border-color 0.3s ease, background-color 0.3s ease;
    }

    /* Highlight when a value is selected */
    select.form-select:not(:placeholder-shown) {
   
        background-color: #fff; /* Light blue background */
        color: #000; /* Text color */
    }

    /* Style the input fields when related to dropdown */


    
    
        </style>
        <body class="with-welcome-text">
            <div class="container-scroller">
                <?php
                // include("banner.php");
                include("topnav.php");
                ?>
                <!-- partial:partials/_navbar.html -->

                <!-- partial -->
                <div class="container-fluid page-body-wrapper">
                    <?php
                    include("sidebar.php");
                    ?>
                    <!-- partial -->
                    <div class="main-panel">
                        <div class="content-wrapper">
                            <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                    <?php
                                // Fetch user details
                                $userData = null;
                                if ($User_id > 0) {
                                    $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
                                    $query->bind_param("i", $User_id);
                                    $query->execute();
                                    $result = $query->get_result();
                                    $userData = $result->fetch_assoc();
                                }

                                // Notification if profile is incomplete
                                if ($userData) {
                                    $requiredFields = ['firstname', 'lastname', 'email', 'mobileno', 'username', 'password'];
                                    $isProfileIncomplete = false;

                                    foreach ($requiredFields as $field) {
                                        if (empty($userData[$field])) {
                                            $isProfileIncomplete = true;
                                            break;
                                        }
                                    }

                                    if ($isProfileIncomplete) {
                                        echo "<div class='alert alert-warning'>Please complete your profile to continue.</div>";
                                    }
                                }

                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    // Fetch and sanitize form data
                                    $firstName = trim($_POST['firstname']);
                                    $lastName = trim($_POST['lastname']);
                                    $email = trim($_POST['email']);
                                    $mobile = trim($_POST['mobileno']);
                                    $gender = trim($_POST['gender']);
                                    $dob = trim($_POST['dob']);
                                    $category = trim($_POST['department']);
                                    $address2 = trim($_POST['address']);
                                    $username = trim($_POST['username']);
                                    $password = trim($_POST['password']);

                                    // Check for empty fields
                                    if (empty($firstName) || empty($lastName) || empty($email) || empty($mobile) || empty($username) || empty($password)) {
                                        echo "<div class='alert alert-danger'>Please complete all required fields.</div>";
                                    } else {
                                    // Update the user data in the database
                                    $updateQuery = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=?, mobileno=?, gender=?, dob=?, department=?, address=?, username=?, password=? WHERE id=?");
                                    $updateQuery->bind_param("ssssssssssi", $firstName, $lastName, $email, $mobile, $gender, $dob, $category, $address2, $username, $password, $User_id);
                                                                        
                                    if ($updateQuery->execute()) {
                                        echo "<div class='alert alert-success'>User details updated successfully.</div>";
                                        
                                     echo "<script>window.location.href=window.location.href;</script>";
                                        exit();
                                    } else {
                                        echo "<div class='alert alert-danger'>Error updating user details: " . $conn->error . "</div>";
                                    }

                                    }
                                }
                                ?>                              
                                        <h4 class="card-title">Data Information</h4>
                                        <form class="form-sample" method="POST" >
                                    <p class="card-description"> Personal info </p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">

                                            <input type="hidden" name="User_id" class="form-control" value="<?= htmlspecialchars($User_id ?? '') ?>" />

                                                <label class="col-sm-3 col-form-label">First Name</label>   
                                                <div class="col-sm-9">
                                                    <input type="text" name="firstname" class="form-control" value="<?= htmlspecialchars($userData['firstname'] ?? '') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="lastname" class="form-control" value="<?= htmlspecialchars($userData['lastname'] ?? '') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($userData['email'] ?? '') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Mobile No.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="mobileno" class="form-control" value="<?= htmlspecialchars($userData['mobileno'] ?? '') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Gender</label>
                                                <div class="col-sm-9">
                                                    <select name="gender" class="form-select">
                                                        <option <?= isset($userData['gender']) && $userData['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                                        <option <?= isset($userData['gender']) && $userData['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date of Birth</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="dob" class="form-control" value="<?= htmlspecialchars($userData['dob'] ?? '') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($userData['username'] ?? '') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password" class="form-control" value="<?= htmlspecialchars($userData['password'] ?? '') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Position</label>
                <div class="col-sm-9">
                    <select name="position" class="form-select">
                    <option <?= isset($userData['position']) && $userData['position'] == 'Teacher' ? 'selected' : '' ?>>Teacher</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Principal' ? 'selected' : '' ?>>Principal</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Administrator' ? 'selected' : '' ?>>Administrator</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Staff' ? 'selected' : '' ?>>Staff</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Dean' ? 'selected' : '' ?>>Dean</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Secretary' ? 'selected' : '' ?>>Secretary</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Guidance Counselor' ? 'selected' : '' ?>>Guidance Counselor</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Librarian' ? 'selected' : '' ?>>Librarian</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'IT Specialist' ? 'selected' : '' ?>>IT Specialist</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Finance Officer' ? 'selected' : '' ?>>Finance Officer</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Registrar' ? 'selected' : '' ?>>Registrar</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Clinic Staff' ? 'selected' : '' ?>>Clinic Staff</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Researcher' ? 'selected' : '' ?>>Researcher</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Security' ? 'selected' : '' ?>>Security</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Maintenance' ? 'selected' : '' ?>>Maintenance</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Scholarship Coordinator' ? 'selected' : '' ?>>Scholarship Coordinator</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'HR Officer' ? 'selected' : '' ?>>HR Officer</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Evaluator' ? 'selected' : '' ?>>Evaluator</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Cashier' ? 'selected' : '' ?>>Cashier</option>
                    <option <?= isset($userData['position']) && $userData['position'] == 'Bookkeeper' ? 'selected' : '' ?>>Bookkeeper</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Office</label>
                <div class="col-sm-9">
                    <select name="department" class="form-select">
                    <option <?= isset($userData['department']) && $userData['department'] == 'Criminology' ? 'selected' : '' ?>>Criminology</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'BSA Office' ? 'selected' : '' ?>>BSA Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == "Evaluator's Office 1" ? 'selected' : '' ?>>Evaluator's Office 1</option>
                    <option <?= isset($userData['department']) && $userData['department'] == "Evaluator's Office 2" ? 'selected' : '' ?>>Evaluator's Office 2</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'HR' ? 'selected' : '' ?>>HR</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'BSOAD Office' ? 'selected' : '' ?>>BSOAD Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Research Office' ? 'selected' : '' ?>>Research Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Education/Dean Office' ? 'selected' : '' ?>>Education/Dean Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'OSA Office' ? 'selected' : '' ?>>OSA Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Highschool Dept.Office' ? 'selected' : '' ?>>Highschool Dept.Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Bookkeepping' ? 'selected' : '' ?>>Bookkeepping</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'ITE Dept.Office' ? 'selected' : '' ?>>ITE Dept.Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Registrar' ? 'selected' : '' ?>>Registrar</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Information Analyist' ? 'selected' : '' ?>>Information Analyist</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Clinic' ? 'selected' : '' ?>>Clinic</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Faculty Office' ? 'selected' : '' ?>>Faculty Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Scholarship Office' ? 'selected' : '' ?>>Scholarship Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Finance Office' ? 'selected' : '' ?>>Finance Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == "Cashier's Office" ? 'selected' : '' ?>>Cashier's Office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Library' ? 'selected' : '' ?>>Library</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Admin office' ? 'selected' : '' ?>>Admin office</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'Conference Room' ? 'selected' : '' ?>>Conference Room</option>
                    <option <?= isset($userData['department']) && $userData['department'] == 'AVR' ? 'selected' : '' ?>>AVR</option>

                    </select>
                </div>
            </div>
        </div>
    </div>

                                    <p class="card-description"> Address </p>   
                                    <div class="row">
                                        <div class="col-md-12 mb-5">
                                           
                                              
                                                <div class="col-sm-12">
                                                    <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($userData['address'] ?? '') ?>" />
                                                </div>
                                      
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- content-wrapper ends -->
                        <!-- partial:../../partials/_footer.html -->
                        <?php
                        include("footer.php");
                        ?>
                    </div>
                </div>
            </div>
        </body>
            