<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="index.html">
              <img src="../LOGO1.png" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
              <img src="assets/images/logo-mini.svg" alt="logo" />
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
             <?php
// Get the current time
$currentHour = date('H'); // Hour in 24-hour format
$currentDay = date('l'); // Full day name, e.g., "Monday"
$currentDate = date('F j, Y'); // Full date, e.g., "December 10, 2024"

// Determine greeting based on the time
if ($currentHour < 12) {
    $greeting = "Good Morning";
} elseif ($currentHour < 18) {
    $greeting = "Good Afternoon";
} else {
    $greeting = "Good Evening";
}
?>

<h1 class="welcome-text"><?= $greeting; ?>, <span class="text-black fw-bold"><?= htmlspecialchars($username); ?></span></h1>
<h3 class="welcome-sub-text">Today is <?= $currentDay; ?>, <?= $currentDate; ?>. Your performance summary this week:</h3>

            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
     
 
<li class="nav-item dropdown ">
    <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="categoryDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="categoryDropdown">
        <a class="dropdown-item py-3">
            <p class="mb-0 fw-medium float-start">Select category</p>
        </a>
        <div class="dropdown-divider"></div>

        <?php


        $sql_category = "SELECT id, category_name FROM category"; // Adjust table & column names as needed
        $result = $conn->query($sql_category);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a class="dropdown-item preview-item" href="category.php?product_category=' . urlencode($row['id']) . '">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis fw-medium text-dark">' . htmlspecialchars($row['category_name']) . '</p>
                        </div>
                      </a>';
            }
        } else {
            echo '<a class="dropdown-item preview-item">
                    <div class="preview-item-content flex-grow py-2">
                        <p class="fw-light small-text mb-0">No categories found</p>
                    </div>
                  </a>';
        }
        ?>
    </div>
</li>

<li class="nav-item dropdown">

<?php
// Query to count the number of pending product requests
$query_product_release = "SELECT COUNT(*) AS release_count FROM product_requests WHERE session_id = '$User_id' AND status = 'Released'";
$result_query_product_release = mysqli_query($conn, $query_product_release);
$requestCount = 0;

if ($result_query_product_release && $row = mysqli_fetch_assoc($result_query_product_release)) {
    $ReleaseCount = $row['release_count'];
}
?>


              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="icon-bell"></i>
                <?= $ReleaseCount; ?>
                <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a  href="product-list.php" class="dropdown-item py-3 border-bottom">


<p class="mb-0 fw-medium float-start">You have <?= $ReleaseCount; ?> request is ready for releasing</p>

                  <span class="badge badge-pill badge-primary float-end">View all</span>
                </a>
              
              </div>
            </li>
           
            <?php
// Fetch user details from the database
$query = "SELECT username, email, profile_image FROM users WHERE id = '$User_id'";
$result = mysqli_query($conn, $query);

// Check if the user exists
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $userName = $user['username'];
    $userEmail = $user['email'];
    $userImage = !empty($user['profile_image']) ? $user['profile_image'] : '../gfi-logo.png'; // Default image if none
} else {
    // Handle the case where the user is not found in the database
    $userName = 'Guest';
    $userEmail = 'guest@example.com';
    $userImage = '../gfi-logo.png'; // Default image for guest
}
?>


<li class="nav-item dropdown d-none d-lg-block user-dropdown">
    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="img-xs rounded-circle" src="<?php echo $userImage; ?>" alt="Profile image">
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
        <div class="dropdown-header text-center">
            <img class="img-md rounded-circle" src="<?php echo $userImage; ?>" alt="Profile image" height="150px">
            <p class="mb-1 mt-3 fw-semibold"><?php echo $userName; ?></p>
            <p class="fw-light text-muted mb-0"><?php echo $userEmail; ?></p>
        </div>
    
    </div>
</li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>