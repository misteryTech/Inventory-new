<?php
include("header.php");
include("connection.php"); // Ensure database connection is included




// Get the selected category ID from URL (default to 0 if not set)
$category_id = isset($_GET['product_category']) ? intval($_GET['product_category']) : 0;

// Fetch products from the database (filter by category if selected)
if ($category_id > 0) {
    $query_product = "SELECT * FROM products WHERE product_category = ?";
    $stmt = $conn->prepare($query_product);
    $stmt->bind_param("s", $category_id);
    $stmt->execute();
    $result_query = $stmt->get_result();
} else {
    $query_product = "SELECT * FROM products";
    $result_query = $conn->query($query_product);
}

// Check if today is Wednesday
$isWednesday = (date('l') == 'Wednesday');
?>

<body>
    <div class="container-scroller">
        <?php include("topnav.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include("sidebar.php"); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
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
                                                    if ($result_query->num_rows > 0) {
                                                        while ($row = $result_query->fetch_assoc()) {
                                                            $image_path = !empty($row['product_image']) ? '../admin/process/' . $row['product_image'] : 'assets/images/default-image.jpg';
                                                            echo "<tr>";
                                                            echo "<td><input type='checkbox' name='selected_products[]' value='" . htmlspecialchars($row['batch_number']) . "' class='form-check-input'></td>";
                                                            echo "<td>
                                                                    <div class='d-flex'>
                                                                        <img src='$image_path' alt='Product Image'>
                                                                        <div>
                                                                            <h6>" . htmlspecialchars($row['product_name']) . "</h6>
                                                                        </div>
                                                                    </div>
                                                                  </td>";
                                                            echo "<td><h6 class='product-stock'>" . htmlspecialchars($row['stock']) . "</h6></td>";
                                                            echo "<td><h6>" . htmlspecialchars($row['product_category']) . "</h6></td>";
                                                            echo "<td>
                                                                    <input type='number' name='request_quantity[" . htmlspecialchars($row['batch_number']) . "]' class='form-control' min='1' placeholder='Enter quantity'>
                                                                  </td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='5'>No products available.</td></tr>";
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
                <?php include("footer.php"); ?>
            </div>
        </div>
    </div>
</body>

<script>
$(document).ready(function () {
    // Check user details on page load
    $.ajax({
        url: "validate/check_user_details.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response.complete) {
                alert("Please complete your profile before accessing this page.");
                window.location.href = "profile-page.php"; // Redirect to profile page
            }
        },
        error: function () {
            alert("Error checking user details.");
        }
    });
});


    
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


</script>
