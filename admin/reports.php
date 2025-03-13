<?php
include("header.php");
?>
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
                                <h4 class="card-title">Reports</h4>
                              
                                
                        
                                
                                <div class="table-responsive">
                                    <table class="table table-striped" id="affiliateTable">
                                        <thead>
                                            <tr>
                                              
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Category</th>
                                                <th>Item Request</th>
                                                <th>Price</th>
                                                <th>Request Date</th>
                                                <th>Approved By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            // $query = "SELECT * FROM products WHERE archive='Yes'"; 
                                            // $result = mysqli_query($conn, $query);

                                            // if (mysqli_num_rows($result) > 0) {
                                            //     while ($row = mysqli_fetch_assoc($result)) {
                                            //         $productId = $row['id'];
                                            //         echo "<tr>";
                                                 
                                            //         // Display product details
                                            //         echo "<td><img src='process/" . $row['qr_code_path'] . "' alt='QR Code' width='100' height='150'></td>";
                                                  
                                            //         echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                                            //         echo "<td>" . htmlspecialchars($row['product_category']) . "</td>";
                                            //         echo "<td>" . htmlspecialchars($row['product_condition']) . "</td>";
                                            //         echo "<td>" . htmlspecialchars($row['product_price']) . "</td>";
                                            //         echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                                            //         echo "<td>
                                                      
                                            //             <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#archiveModal$productId'>Restore</button>
                                            //         </td>";
                                            //         echo "</tr>";

                                            //         // Edit Modal
                                            //         echo "<div class='modal fade' id='editModal$productId' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                                            //             <div class='modal-dialog'>
                                            //                 <div class='modal-content'>
                                            //                     <div class='modal-header'>
                                            //                         <h5 class='modal-title' id='editModalLabel'>Edit Product</h5>
                                            //                         <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            //                     </div>
                                            //                     <form action='process/edit_product.php' method='POST'>
                                            //                         <div class='modal-body'>
                                            //                             <input type='hidden' name='id' value='$productId'>
                                            //                             <div class='mb-3'>
                                            //                                 <label for='productName' class='form-label'>Product Name</label>
                                            //                                 <input type='text' class='form-control' name='product_name' value='" . htmlspecialchars($row['product_name']) . "' required>
                                            //                             </div>
                                            //                             <div class='mb-3'>
                                            //                                 <label for='productPrice' class='form-label'>Price</label>
                                            //                                 <input type='number' step='0.01' class='form-control' name='product_price' value='" . htmlspecialchars($row['product_price']) . "' required>
                                            //                             </div>
                                            //                             <div class='mb-3'>
                                            //                                 <label for='stock' class='form-label'>Stock</label>
                                            //                                 <input type='number' class='form-control' name='stock' value='" . htmlspecialchars($row['stock']) . "' required>
                                            //                             </div>
                                            //                         </div>
                                            //                         <div class='modal-footer'>
                                            //                             <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            //                             <button type='submit' class='btn btn-primary'>Save Changes</button>
                                            //                         </div>
                                            //                     </form>
                                            //                 </div>
                                            //             </div>
                                            //         </div>";

                                            //         // Archive Modal
                                            //         echo "<div class='modal fade' id='archiveModal$productId' tabindex='-1' aria-labelledby='archiveModalLabel' aria-hidden='true'>
                                            //             <div class='modal-dialog'>
                                            //                 <div class='modal-content'>
                                            //                     <div class='modal-header'>
                                            //                         <h5 class='modal-title' id='archiveModalLabel'>Archive Product</h5>
                                            //                         <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            //                     </div>
                                            //                     <div class='modal-body'>
                                            //                         Are you sure you want to restore this product?
                                            //                     </div>
                                            //                     <div class='modal-footer'>
                                            //                         <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                            //                         <a href='process/restore_product.php?id=$productId' class='btn btn-success'>Restore</a>
                                            //                     </div>
                                            //                 </div>
                                            //             </div>
                                            //         </div>";
                                            //     }
                                            // } else {
                                            //     echo "<tr><td colspan='7'>No products found</td></tr>";
                                            // }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include("footer.php"); ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Include DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- Include DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <!-- JavaScript to handle the View & Print action -->
    <script>
        $(document).ready(function() {
            $('#affiliateTable').DataTable(); // Initialize DataTables
        });

        document.getElementById('viewSelectedBtn').addEventListener('click', function() {
            // Get selected product IDs
            var selectedProducts = [];
            var checkboxes = document.querySelectorAll('.product-checkbox:checked');
            checkboxes.forEach(function(checkbox) {
                selectedProducts.push(checkbox.value);
            });

            if (selectedProducts.length > 0) {
                // You can pass the selected product IDs to another page for viewing or printing
                var printWindow = window.open('view_print_selected.php?product_ids=' + selectedProducts.join(','), '_blank');
                printWindow.focus();
            } else {
                alert('Please select at least one product to view and print.');
            }
        });

        // Handle the Select All checkbox
        document.getElementById('selectAllCheckbox').addEventListener('change', function() {
            var isChecked = this.checked;
            var checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });
    </script>
</body>
