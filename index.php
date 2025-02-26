<?php
include("header.php");


?>
  <style>
.content-wrapper  {
  background-image: url('blur-bg.jpg');
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-5 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                
                                <h2 style="color:red; font-style: arial;">Online Inventory System</h2>
                            </div>

            
                            <h4>Hello! Let's get started</h4>
                            <h6 class="fw-light">Sign in to continue.</h6>
                            <form class="pt-3" method="POST" action="process/authenticate.php">
                                <div class="form-group">
                                <input type="text" name="identifier" class="form-control form-control-lg" placeholder="Username or Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">Login</button>
                                </div>
                     
                                <div class="text-center mt-4 fw-light">
                                    Don't have an account? <a href="register.php" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
<?php
include("footer.php");
?>
