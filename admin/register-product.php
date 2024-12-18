<?php
    include("header.php");
?>
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
            <label for="productName">Batch Number</label>
            <div class="input-group">
                 <input type="text" class="form-control" id="batchNumber" name="batch_number" placeholder="Enter batch number" required>
                 <button type="button" class="btn btn-secondary" id="generateBatchNumber">Generate</button>
            </div>
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
          <div class="col-md-6">
              <label for="productStock">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter stock" required>
          </div>
          
          <div class="col-md-6">
              <label for="reorderPoint">Reorder Point</label>
              <input type="number" class="form-control" id="reorderPoint" name="reorder_point" placeholder="Enter reorder point" required>
          </div>
      </div>
      

      

                <div class="form-group mt-3">
            <label for="supplier">Supplier</label>

            <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Supplier" required>
          
        </div>



        <div class="form-group mt-3">
    <label for="productUnit" class="form-label">Product Unit</label>
    <div class="input-group">
        <select class="form-select" id="productUnit" name="product_unit" required>
            <option selected>--Select Unit--</option>
            <option value="Piece">Piece</option>
            <option value="Box">Box</option>
            <option value="Kg">Kilogram (Kg)</option>
            <option value="Litre">Litre</option>
            <option value="Meter">Meter</option>
            <option value="Other">Other</option>
        </select>
        <span class="input-group-text">📦</span>
    </div>
</div>

<div class="form-group mt-3">
    <label for="condition" class="form-label">Condition</label>
    <div class="input-group">
        <select class="form-select" id="condition" name="condition" required>
            <option selected>--Select Condition--</option>
            <option value="New">New</option>
            <option value="Used">Used</option>
            <option value="Refurbished">Refurbished</option>
            <option value="Damaged">Damaged</option>
        </select>
        <span class="input-group-text">🛠️</span>
    </div>
</div>

<div class="form-group mt-3">
    <label for="productCategory" class="form-label">Category</label>
    <div class="input-group">
        <select class="form-select" id="productCategory" name="product_category" required>
            <option value="Electronics">Electronics</option>
            <option value="Fashion">Fashion</option>
            <option value="Home & Kitchen">Home & Kitchen</option>
            <option value="Beauty">Beauty</option>
            <option value="Other">Other</option>
        </select>
        <span class="input-group-text">📂</span>
    </div>
</div>



        <div class="form-group mt-3">
            <label for="productImage">Upload Product Image</label>
            <input type="file" class="form-control" id="productImage" name="product_image">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Register Product</button>
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
   <script>
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



   </script>