<?php
    include("header.php");
?>

<style>
  select.form-select {
        color:black;
    }
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
        include("sidebar.php")
      ?>


        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">



          <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Product Registration Form</h4>
                    <p class="card-description"> Products Information </p>



                    <form action="process/register_product.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
    <label for="batchNumber">Serial Number</label>
    <div class="input-group">
        <input type="text" class="form-control" id="batchNumber" name="batch_number" placeholder="Enter batch number" required>
        <button type="button" class="btn btn-secondary" id="generateBatchNumber">Generate</button>
    </div>
    <small id="batchCheckResult" class="text-muted"></small>
</div>

<div class="form-group mt-3">
    <label for="productName">Product Name</label>
    <input type="text" class="form-control" id="productName" name="product_name" placeholder="Enter product name" required>
</div>

        <div class="form-group mt-3">
            <label for="productDescription">Product Description</label>
            <textarea class="form-control" id="productDescription" name="product_description" rows="4" placeholder="Enter product description" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="productPrice">Price</label>
            <input type="number" step="0.01" class="form-control" id="productPrice" name="product_price" placeholder="Enter price" required>
        </div>


              <div class="form-group mt-3 row">
          <div class="col-md-12">
              <label for="productStock">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter stock" required>
          </div>

       
              <input type="hidden" class="form-control" id="reorderPoint" name="reorder_point" placeholder="Enter reorder point" value="3" >
   
      </div>




                <div class="form-group mt-3">
            <label for="supplier">Supplier</label>

            <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Supplier" required>

        </div>



        <div class="form-group mt-3">
    <label for="productUnit" class="form-label">Product Unit</label>
    <div class="input-group">

    <?php
                $query_unit = "SELECT unit FROM unit";
                $result_unit = mysqli_query($conn, $query_unit);
    ?>
        <select class="form-select" id="productUnit" name="product_unit" required>
        <?php while ($row = mysqli_fetch_assoc($result_unit)) { ?>
            <option value="<?= htmlspecialchars($row['unit']) ?>"><?= htmlspecialchars($row['unit']) ?></option>
        <?php } ?>
        </select>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addUnitModal">
        Add Unit
    </button>

    </div>

</div>

<div class="form-group mt-3">
    <label for="condition" class="form-label">Condition</label>
    <select class="form-select" id="condition" name="condition" required>
        <option selected>--Select Condition--</option>
        <option value="New">New</option>
        <option value="Used">Used</option>
        <option value="Refurbished">Refurbished</option>
        <option value="Damaged">Damaged</option>
    </select>
  


</div>


<div class="form-group mt-3">
    <label for="productCategory" class="form-label">Category</label>
    <div class="input-group">

    <?php
                $query_category = "SELECT id,category_name FROM category";
                $result_category = mysqli_query($conn, $query_category);
    ?>


        <select class="form-select" id="productCategory" name="product_category" required>
        <?php while ($row_category = mysqli_fetch_assoc($result_category)) { ?>
            <option value="<?= htmlspecialchars($row_category['id']) ?>"><?= htmlspecialchars($row_category['category_name']) ?></option>
        <?php } ?>


        </select>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add Category
    </button>


    </div>

        <div class="form-group mt-3">
            <label for="productImage">Upload Product Image</label>
            <input type="file" class="form-control" id="productImage" name="product_image">
        </div>
        <button type="submit" class="btn btn-success mt-4">Register Product</button>
    </form>


    
<!-- Modal for Adding New Unit -->
<div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUnitModalLabel">Add New Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUnitForm"  method="POST">
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit Name</label>
                        <input type="text" class="form-control" id="unit" name="unit">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Unit</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Modal for Adding New Unit -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm">
                    <div class="mb-3">
                        <label for="newCategory" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="newCategory" name="newCategory" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Unit</button>
                </form>
            </div>
        </div>
    </div>
</div>





                  </div>
                </div>
              </div>


          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
   <?php
            include("footer.php");
   ?>
   <script>


document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('registerUnitForm').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Unit Registered: ' + document.getElementById('newUnitName').value);
            const modal = bootstrap.Modal.getInstance(document.getElementById('registerUnitModal'));
            modal.hide();
        });
    });


      document.getElementById("generateBatchNumber").addEventListener("click", function(){

        const timestamp = new Date().getTime();
        const randomLetters = (length) => {
    const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let result = "";
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * alphabet.length);
        result += alphabet[randomIndex];
    }
    return result;
  };
        const randomSuffix = Math.floor(Math.random() * 1000);
        const batchNumber = `${randomLetters(3)}-${timestamp}-${randomSuffix}`;


        document.getElementById("batchNumber").value = batchNumber;
      });



      $(document).ready(function () {
            // Handle form submission to add a new unit
                 $('#addUnitForm').submit(function (e) {
                     e.preventDefault();
                          let newUnit = $('#unit').val();

                     $.ajax({
                         url: 'process/add_unit.php', // API to add unit to database
                         type: 'POST',
                         data: { unit: newUnit },
                         success: function (response) {
                             alert(response);
                             $('#addUnitModal').modal('hide'); // Close modal
                             location.reload();
                         }
                     });
                 });


                 $('#addCategoryForm').submit(function (e){
                     e.preventDefault();
                          let newCategory = $('#newCategory').val();

                     $.ajax({
                         url: 'process/add_category.php', // API to add unit to database
                         type: 'POST',
                         data: { category_name: newCategory },
                         success: function (response) {
                             alert(response);
                             $('#addCategoryModal').modal('hide'); // Close modal
                             location.reload();
                         }
                     });

                 });
      });




      document.getElementById('batchNumber').addEventListener('blur', function () {
    let batchNumber = this.value.trim();
    let resultText = document.getElementById('batchCheckResult');

    if (batchNumber === '') {
        resultText.textContent = "";
        return;
    }

    fetch(`process/check-product.php?batch_number=${batchNumber}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                resultText.textContent = "✔ Product exists in the database.";
                resultText.classList.remove("text-danger");
                resultText.classList.add("text-success");
            } else {
                resultText.textContent = "❌ Product not found.";
                resultText.classList.remove("text-success");
                resultText.classList.add("text-danger");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            resultText.textContent = "⚠ Error checking product.";
            resultText.classList.add("text-danger");
        });
});
   </script>