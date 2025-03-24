<?php include("header.php"); ?>

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
                                <h4 class="card-title">Product Table</h4>
                                <p class="card-description">
                                    Manage products with filtering, Edit, Archive options, and select for printing.
                                </p>

                                <!-- Tab Pills for Stock Categories -->
                                <ul class="nav nav-pills" id="stockTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="inStockTab" data-bs-toggle="pill" href="#inStock" role="tab" aria-controls="inStock" aria-selected="true">In Stock</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="belowReorderTab" data-bs-toggle="pill" href="#belowReorder" role="tab" aria-controls="belowReorder" aria-selected="false">Below Reorder Point</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="damagedTab" data-bs-toggle="pill" href="#damaged" role="tab" aria-controls="damaged" aria-selected="false">Damaged</a>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content mt-3" id="stockTabsContent">
                                    <!-- In Stock Products -->
                                    <div class="tab-pane fade show active" id="inStock" role="tabpanel" aria-labelledby="inStockTab">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="inStockTable">
                                                <thead>
                                                    <tr>
                                                
                                            
                                                        <th>Product Name</th>
                                                        <th>Category</th>
                                                        <th>Condition</th>
                                                        <th>Stock</th>
                                                        <th>Reorder Point</th>
                                                        <th>Last Updated</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Query to retrieve products that are in stock
                                                    $query = "SELECT * FROM products WHERE stock > reorder_point AND archive='No' ORDER BY created_at DESC";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                               
                                                 
                                                        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['product_category']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['product_condition']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['reorder_point']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Below Reorder Products -->
                                    <div class="tab-pane fade" id="belowReorder" role="tabpanel" aria-labelledby="belowReorderTab">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="belowReorderTable">
                                                <thead>
                                                    <tr>
                                         
                                                       
                                                        <th>Product Name</th>
                                                        <th>Category</th>
                                                        <th>Condition</th>
                                                        <th>Stock</th>
                                                        <th>Reorder Point</th>
                                                        <th>Last Updated</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Query to retrieve products below reorder point
                                                    $query = "SELECT * FROM products WHERE stock <= reorder_point AND archive='No' ORDER BY created_at DESC";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                               
                                                    
                                                        echo "<td>" . htmlspecialchars($row['product_category']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['product_condition']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['reorder_point']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                      <!-- Below Reorder Products -->
                                      <div class="tab-pane fade" id="damaged" role="tabpanel" aria-labelledby="damagedTab">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="damageTable">
                                                <thead>
                                                    <tr>
                                            
                                                  
                                                        <th>Product Name</th>
                                                        <th>Category</th>
                                                        <th>Condition</th>
                                                        <th>Stock</th>
                                                        <th>Reorder Point</th>
                                                        <th>Last Updated</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Query to retrieve products below reorder point
                                                    $query = "SELECT * FROM products WHERE  product_condition = 'Damage' ORDER BY created_at DESC";
                                                    $result = mysqli_query($conn, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                           
                                                     
                                                        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['product_category']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['product_condition']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['reorder_point']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                                        echo "</tr>";
                                                             }
                                                    }else{
                                                        echo "<tr><td colspan='8'>No products found.</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
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

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>



    <script>
   $(document).ready(function () {
    // In Stock Table
    $('#inStockTable').DataTable({
        dom: 'Bfrtip', // Add buttons to the DataTable
        buttons: [
            {
                extend: 'print',
                text: 'Print Selected Columns', // Customize button text
                exportOptions: {
                    columns: [0, 2, 3, 4, 5] // Specify column indexes to print
                }
            }
        ]
    });

    // Below Reorder Table
    $('#belowReorderTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print Selected Columns',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5] // Adjust column indexes as needed
                }
            }
        ]
    });

    // Damaged Table
    $('#damageTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print Selected Columns',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5] // Adjust column indexes as needed
                }
            }
        ]
    });
});

    </script>
</body>
