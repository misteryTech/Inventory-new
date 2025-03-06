<?php
   include("header.php");
?>
<body class="with-welcome-text">
    <div class="container-scroller">
        <?php
        // include("banner.php");
        include("topnav.php");
        ?>
        <div class="container-fluid page-body-wrapper">
            <?php
            include("sidebar.php")
            ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#User" role="tab" aria-selected="false">User</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#Products" role="tab" aria-selected="false">Products</a>
                                        </li>
                                    </ul>
                                    <div>
                                        <!-- <div class="btn-wrapper">
                                            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                                            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                                            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- single tab-content for all sections -->
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="home-tab">
                                        <!-- Dashboard Content -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Request Item</p>
                                                        <h3 class="rate-percentage"></h3>
                                                     
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Release Item</p>
                                                        <h3 class="rate-percentage">7,682</h3>
                                             
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Products</p>
                                                        <h3 class="rate-percentage">68.8</h3>
                                                     
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Total User</p>
                                                        <h3 class="rate-percentage">2m:35s</h3>
                                                 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="User" role="tabpanel" aria-labelledby="profile-tab">
                                        <!-- User Content -->
                                        <div class="row">
    <div class="col-lg-12 d-flex flex-column">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title">Requested Products</h4>
                
                <div class="table-responsive mt-3">
                <table class="table table-striped">
    <thead>
        <tr>
            <th>Request Name</th>
            <th>Department</th>
            <th>Request Date</th>
            <th>Status</th>
            <th>Release No.</th>
            <th>View Item</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch requested products from the database
        $query_pr = "SELECT PR.*, U.*
        
         FROM product_requests AS PR
         INNER JOIN users AS U ON U.id = PR.session_id 
        ";
        $result_pr = mysqli_query($conn, $query_pr);

        if ($result_pr && mysqli_num_rows($result_pr) > 0) {
            while ($row_pr = mysqli_fetch_assoc($result_pr)) {
                $status = htmlspecialchars($row_pr['status']);
                $requestId = htmlspecialchars($row_pr['request_id']);

                echo "<tr>";
                echo "<td>" . htmlspecialchars($row_pr['firstname']. ' ' . $row_pr['lastname']) . "</td>";
                echo "<td>" . htmlspecialchars($row_pr['department']) . "</td>";
                echo "<td>" . htmlspecialchars($row_pr['request_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row_pr['status']) . "</td>";
                echo "<td>" . htmlspecialchars($row_pr['release_form']) . "</td>";
                
                // Display status with colored badge
                echo "<td>";
                // Fetch products based on request_id
                $productQuery = "SELECT P.product_name, RP.status, RP.quantity, P.batch_number
                                 FROM request_products AS RP
                                 INNER JOIN products AS P ON RP.product_id = P.batch_number
                                 WHERE RP.request_id = '$requestId'";
                $productResult = mysqli_query($conn, $productQuery);

                if (mysqli_num_rows($productResult) > 0) {
                    echo "<ul>";
                    while ($product = mysqli_fetch_assoc($productResult)) {
                        $productName = htmlspecialchars($product['product_name']);
                        $status = htmlspecialchars($product['status']);
                        $quantity = htmlspecialchars($product['quantity']);
                        echo "<h6><li>{$productName}</h6> -  Status: {$status}, Quantity: {$quantity}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No products found for this request.</p>";
                }
                echo "</td>";

                // Release button
                echo "<td>";
                if ($status !== 'Released') {
                    echo "<form method='POST' action='process/release_product.php'>";
                    echo "<input type='hidden' name='request_id' value='" . htmlspecialchars($row_pr['request_id']) . "'>";

                    // Add product info for release
                    $productResult = mysqli_query($conn, $productQuery); // Re-query products
                    if (mysqli_num_rows($productResult) > 0) {
                        while ($product = mysqli_fetch_assoc($productResult)) {
                            echo "<input type='hidden' name='session_id' value='" . htmlspecialchars($row_pr['session_id']) . "'>";
                            echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($product['product_name']) . "'>";
                            echo "<input type='hidden' name='batch_number' value='" . htmlspecialchars($product['batch_number']) . "'>";
                            echo "<label for='quantity'>Quantity to Release:</label>";
                            echo "<input type='number' name='quantity' value='" . htmlspecialchars($product['quantity']) . "' min='1' max='" . htmlspecialchars($product['quantity']) . "' required>";
                            echo "<br>";
                        }
                    }

                    echo "<button type='submit' name='release_request' class='btn btn-secondary btn-sm'>Release Request</button>";
                    echo "</form>";
                } else {
                    echo "<button class='btn btn-primary btn-sm' disabled>Released</button>";
                }
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No product requests found.</td></tr>";
        }
        ?>
    </tbody>
</table>

                </div> <!-- table-responsive -->
            </div> <!-- card-body -->
        </div> <!-- card -->
    </div> <!-- col-lg-12 -->
</div> <!-- row -->

                                    </div>

                                    <div class="tab-pane fade" id="Products" role="tabpanel" aria-labelledby="contact-tab">
                                        <!-- Products Content -->
                                  
                                        <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                         <?php
                          // Assuming you have a database connection stored in $conn
                          // Fetch products where reorder_point < stock
                          $query = "SELECT * FROM products WHERE reorder_point > stock";
                          $result = mysqli_query($conn, $query);
                          ?>

<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-start">
          <div>
            <h4 class="card-title card-title-dash">Product Reorder List</h4>
            <p class="card-subtitle card-subtitle-dash">You have <?php echo mysqli_num_rows($result); ?> Out of Stocks</p>
          </div>
          <div>
            <a href="register-product.php">
            <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new Product</button></a>
          </div>
        </div>

        <div class="table-responsive mt-1">
          <table class="table select-table">
            <thead>
              <tr>
                <th>Product session_id</th>
       
                <th>Stock</th>
                <th>Reorder Point</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Check if there are any products with reorder_point < stock
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
             
             
                  // Assume the image column is 'product_image' in the database
                  $image_path = !empty($row['product_image']) ? 'process/' . $row['product_image'] : 'assets/images/default-image.jpg';
                  echo "<td><div class='d-flex'><img src='" . $image_path . "' alt='Product Image'><div><h6>" . $row['id'] . "</h6><p>" . $row['product_category'] . "</p></div></div></td>";
           
                  
      
               
                  echo "<td><h6>" . $row['stock'] . "</h6></td>";
                  echo "<td><h6>" . $row['reorder_point'] . "</h6></td>";
                  echo "<td>
 
                  <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#reorderModal'
                data-product-id='" . $row['batch_number'] . "'
                data-current-quantity='" . $row['stock'] . "'>Reorder</button>
          
                </td>";


                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='6'>No products with reorder point less than stock.</td></tr>";
              }
              ?>

              <!-- Reorder Modal -->
<div class="modal fade" id="reorderModal" tabindex="-1" aria-labelledby="reorderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reorderModalLabel">Reorder Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process/reorder_product.php" method="POST">
          <input type="text" name="batch_number" session_id="product_id" id="product_id">
          <input type="text" name="current_stocks" session_id="current_stocks" id="current_stocks">
          <div class="mb-3">
            <label for="reorder_quantity" class="form-label">Quantity Restocks</label>
            <input type="number" name="reorder_quantity" class="form-control" session_id="reorder_quantity" id="reorder_quantity" required>
          </div>
          <div class="mb-3">
            <label for="reorder_notes" class="form-label">Notes (optional)</label>
            <textarea class="form-control" name="reorder_notes" session_id="reorder_notes" id="reorder_notes"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Place Reorder</button>
        </form>
      </div>
    </div>
  </div>
</div>



            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>




                          <div class="row flex-grow">
                        
                            <?php

// Fetch product requests
$sql = "SELECT PR.*, U.*


 FROM product_requests AS PR
 INNER JOIN users AS U ON U.id = PR.session_id ORDER BY request_date DESC";
$result = $conn->query($sql);

// Fetch finished and remaining counts
$finished_sql = "SELECT COUNT(*) AS finished FROM product_requests WHERE status = 'finished'";
$remaining_sql = "SELECT COUNT(*) AS remaining FROM product_requests WHERE status = 'pending'";

$finished_result = $conn->query($finished_sql)->fetch_assoc();
$remaining_result = $conn->query($remaining_sql)->fetch_assoc();

$finished_count = $finished_result['finished'] ?? 0;
$remaining_count = $remaining_result['remaining'] ?? 0;



                            ?>
                           <div class="col-md-6 col-lg-6 grid-margin stretch-card">

</div>


                          </div>
                        </div>
                        <div class="col-lg-4 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                             

                            <div class="card card-rounded">
    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="card-title card-title-dash">Product Requests</h4>
        <p class="mb-0"><?php echo $finished_count; ?> Disposed, <?php echo $remaining_count; ?> Request</p>
      </div>
      <ul class="bullet-line-list">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <li>
              <div class="d-flex justify-content-between">
                <div>    
                  
                
                <a href="view-requestpage.php?request_id=<?php echo urlencode($row['request_id']);?>&username=<?php echo urlencode($username); ?>">
                  <span class="text-light-green"><?php echo htmlspecialchars($row['username']); ?></span> Request Product</div></a>
                <p><?php 
                
                $originalDate = $row['request_date'];
$formattedDate = date("F j, Y h:i A", strtotime($originalDate));
            echo $formattedDate;
?></p>
              </div>
            </li>
          <?php endwhile; ?>
        <?php else: ?>
          <li>No product requests found.</li>
        <?php endif; ?>
      </ul>
      <div class="list align-items-center pt-3">
        <div class="wrapper w-100">
          <p class="mb-0">
            <a href="product-request.php" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
          </p>
        </div>
      </div>
    </div>
  </div>


                          </div>
                          <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title card-title-dash">Type By Amount</h4>
                                      </div>
                                      <div>
                                        <canvas class="my-auto" id="doughnutChart"></canvas>
                                      </div>
                                      <div id="doughnutChart-legend" class="mt-5 text-center"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        
                        </div>
                      </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include("footer.php");
                ?>
            </div>
        </div>
    </div>
</body>
<script>
  // Event listener for when the reorder button is clicked
  var reorderModal = document.getElementById('reorderModal');
  reorderModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var productId = button.getAttribute('data-product-id'); // Extract product ID
    var current_quantity = button.getAttribute('data-current-quantity'); // Extract product ID

    // Set the value of the hidden input field
    var modalProductIdInput = reorderModal.querySelector('#product_id');
    var modalProductQuantity = reorderModal.querySelector('#current_stocks');
    modalProductIdInput.value = productId;
    modalProductQuantity.value = current_quantity;
  });
</script>