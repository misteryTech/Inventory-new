<?php
session_start();

include("connection.php");
// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Replace 'login.php' with the path to your login page
    exit(); // Stop further script execution
} 

$User_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Set timezone to Philippine Standard Time
date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Online Inventory System</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../gfi-logo.png" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

  </head>
<style>
  .content-wrapper {
    background: #ca142c;
    color: #fff;
    font-size: 35px;
    padding: 1.5rem 2.187rem 1.5rem 3.5rem;
    width: 100%;
    -webkit-flex-grow: 1;
    flex-grow: 1;
}



.home-tab .nav-tabs .nav-item .nav-link {
    background: transparent;
    color: #ffffff;
    font-size: 25px;
}


.home-tab .nav-tabs .nav-item .nav-link.active {
    background: transparent;
    color: #08006f;
    font-size: 25px;
}



.home-tab .statistics-details .statistics-title {
    font-style: normal;
    font-weight: 500;
     font-size: 20px;
    line-height: 18px;
    color: #ffffff;
    margin-bottom: 4px;
}

.home-tab .statistics-details .rate-percentage {
    font-style: normal;
    font-weight: bold;
    font-size: 35px;
    line-height: 36px;
    color:rgb(253, 253, 253);
    margin-bottom: 0;
}





</style>