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
                               
       <!-- Dashboard Content -->
       <div class="row">
                                            <div class="col-sm-8">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>


                                                    <?php

// Count total product requests
$query = "SELECT COUNT(*) as request_count FROM product_requests WHERE session_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $User_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$requestCount = $row['request_count'];


                                                    ?>
                                                        <p class="statistics-title">Request Item</p>
                                                        <h3 class="rate-percentage"><?= $requestCount ?></h3>
                                                
                                                    </div>
                                                    <div>

                                                    <?php

// Count total product requests
$remarks = 'Transferred';
$query = "SELECT COUNT(*) as transfer_item FROM product_requests  AS PR
INNER JOIN request_products AS RP ON RP.request_id = PR.request_id
WHERE PR.session_id = ? AND RP.remarks = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $User_id, $remarks);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$transferCount = $row['transfer_item'];

                                                    ?>


                                                        <p class="statistics-title">Transfer Item</p>
                                                        <h3 class="rate-percentage"><?= $transferCount; ?></h3>
                                                 
                                                    </div>

                                                    <div>

                                                    <?php
// Count total product requests
$status = 'Declined';
$query = "SELECT COUNT(*) as decline_item FROM product_requests  AS PR
INNER JOIN request_products AS RP ON RP.request_id = PR.request_id
WHERE PR.session_id = ? AND RP.status = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $User_id, $status);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$declineCount = $row['decline_item'];
                                                    ?>
                                                        <p class="statistics-title">Declined Item</p>
                                                        <h3 class="rate-percentage"><?= $declineCount ?></h3>
                                            
                                                    </div>
                                               
                                                </div>
                                            </div>
                                        </div>


                                    
                                    </div>

                                    <div class="tab-pane fade" id="Products" role="tabpanel" aria-labelledby="contact-tab">
                                        <!-- Products Content -->
                                        <div class="row">
                                        <div class="row">

                                        <div class="col-lg-8 d-flex flex-column">
<?php
// Assuming you have a database connection stored in $conn
// Fetch products from the database
$query = "SELECT * FROM products WHERE  archive='No' ";
$result = mysqli_query($conn, $query);

// Check if today is Wednesday
$isWednesday = (date('l') == 'Wednesday');
?>

<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-start">
          <div>
            <h4 class="card-title card-title-dash">Request Product Form</h4>
            <p class="card-subtitle card-subtitle-dash">Select products you want to request.</p>
          </div>
        </div>


        <?php if ($isWednesday): ?>
                                                                    <div class="alert alert-warning" role="alert">
                                                                        Sorry, product requests are not allowed on Wednesdays.
                                                                    </div>
                                                                <?php else: ?>


        <form id="productRequestForm" onsubmit="showConfirmationModal(event)">
          <div class="table-responsive mt-1">
            <table class="table select-table">
              <thead>
                <tr>
                  <th>Select</th>
                  <th>Product Name</th>
                  <th>Stock</th>
                  <th>Category</th>
                  <th width="60px">Quantity to Request</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Display products
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $image_path = !empty($row['product_image']) ? '../admin/process/' . $row['product_image'] : 'assets/images/default-image.jpg';
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='selected_products[]' value='" . $row['batch_number'] . "' class='form-check-input'></td>";
                    echo "<td>
                            <div class='d-flex'>
                              <img src='$image_path' alt='Product Image'>
                              <div>
                                <h6>" . $row['product_name'] . "</h6>
                             
                              </div>
                            </div>
                          </td>";
                    echo "<td><h6 class='product-stock'>" . $row['stock'] . "</h6></td>";
                    echo "<td><h6>" . $row['product_category'] . "</h6></td>";
                    echo "<td>
                            <input type='number' name='request_quantity[" . $row['batch_number'] . "]' class='form-control' min='1' placeholder='Enter quantity'>
                          </td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='4'>No products available.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-success">Submit Request</button>
          </div>
        </form>
<?php endif; ?>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Registration and Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Registration Form -->
        <form id="registrationForm" action="process/submit-request.php" method="POST">
        

          <p><strong>Selected Products:</strong></p>
          <ul id="selectedProductsList"></ul>
          <div class="mb-3">
            <label for="comments" class="form-label">Remarks</label>
            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Confirm Registration and Request</button>
      </div>
      </form>
    </div>
  </div>
</div>


      </div>
    </div>
  </div>
</div>
                        </div>

                        <div class="col-lg-4 d-flex flex-column">
<?php
// Assuming you have a database connection stored in $conn
// Fetch product categories and their total product count
$query = "SELECT category_name, product_category, COUNT(*) AS total_products FROM products as P

INNER JOIN category AS C ON C.id = P.product_category

 WHERE archive='No' GROUP BY product_category";
$result = mysqli_query($conn, $query);
?>

<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-start">
          <div>
            <h4 class="card-title card-title-dash">Product Categories</h4>
            <p class="card-subtitle card-subtitle-dash">Summary of product categories with total counts.</p>
          </div>
        </div>

        <div class="table-responsive mt-1">
          <table class="table select-table">
            <thead>
              <tr>
                <th>Category</th>
                <th>Total Products</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Display product categories and their counts
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td><h6>" . $row['category_name'] . "</h6></td>";
                  echo "<td><h6>" . $row['total_products'] . "</h6></td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='2'>No categories available.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>


<!-- 

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
                          </div> -->
                     
          
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

  
    
function showConfirmationModal(event) {

    
event.preventDefault();

// Get selected products
const selectedProducts = document.querySelectorAll('input[name="selected_products[]"]:checked');
const selectedProductsList = document.getElementById('selectedProductsList');
selectedProductsList.innerHTML = ''; // Clear previous list

let hasError = false; // Track validation errors

// Populate modal with selected product details
selectedProducts.forEach((product) => {
  const productId = product.value;

  // Get corresponding quantity input
  const quantityInput = document.querySelector(`input[name="request_quantity[${productId}]"]`);
  const quantity = quantityInput ? parseInt(quantityInput.value, 10) : 0;

  // Get product details (parent row)
  const productRow = product.closest('tr');
  const productName = productRow.querySelector('h6').textContent.trim();
  const productImage = productRow.querySelector('img').src;

  // Get the available stock
  const stockElement = productRow.querySelector('.product-stock');
  const availableStock = stockElement ? parseInt(stockElement.textContent.trim(), 10) : 0;

  // Validate quantity
  if (isNaN(quantity) || quantity <= 0) {
    alert(`Please enter a valid quantity for ${productName}.`);
    quantityInput.focus();
    hasError = true;
    return;
  }

  if (quantity > availableStock) {
    alert(`Requested quantity for ${productName} exceeds available stock (${availableStock}).`);
    quantityInput.focus();
    hasError = true;
    return;
  }

  // Create list item with product details
  const listItem = document.createElement('li');
  listItem.className = 'd-flex align-items-center mb-2';

  // Add product image
  const imgElement = document.createElement('img');
  imgElement.src = productImage;
  imgElement.alt = productName;
  imgElement.style.width = '50px';
  imgElement.style.height = '50px';
  imgElement.className = 'me-2';

  // Add product name and quantity
  const details = document.createElement('span');
  details.textContent = `${productName} - Quantity: ${quantity}`;

  // Append to list item
  listItem.appendChild(imgElement);
  listItem.appendChild(details);

  // Add list item to modal
  selectedProductsList.appendChild(listItem);

  // Store selected products for form submission
  const selectedProductsInput = document.createElement('input');
  selectedProductsInput.type = 'hidden';
  selectedProductsInput.name = 'selected_products[]';  // name attribute should match the backend code
  selectedProductsInput.value = productId;  // store product ID
  document.getElementById('registrationForm').appendChild(selectedProductsInput);

  // Store quantity for each selected product
  const quantityInputHidden = document.createElement('input');
  quantityInputHidden.type = 'hidden';
  quantityInputHidden.name = `request_quantity[${productId}]`;  // name attribute should match the backend code
  quantityInputHidden.value = quantity;
  document.getElementById('registrationForm').appendChild(quantityInputHidden);
});

// If there are errors, do not show the modal
if (hasError) {
  return;
}

// Show the modal
const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
confirmationModal.show();
}



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



  function redirectToSearch(inputId) {
        let inputValue = document.getElementById(inputId).value;
        let searchPageUrl = 'search_page.php?q=' + encodeURIComponent(inputValue);
        window.location.href = searchPageUrl;
    }


</script>