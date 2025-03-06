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
                                <h4 class="card-title">Product Transfer</h4>
                            
                                
                                <!-- Button to print selected products -->
                                <button class="btn btn-primary mb-3" id="viewSelectedBtn">View & Print Selected</button>
                         
                                <div class="table-responsive">
                                    <table class="table table-striped" id="affiliateTable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="selectAllCheckbox"></th> <!-- Select All checkbox -->
                                                <th>Session ID</th>
                                                <th>Status</th>
                                                <th>Request Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Query to fetch products and barcode
                                            $query = "SELECT PR.*, PR.status AS request_status, RP.* FROM product_requests AS PR
                                            
                                            INNER JOIN request_products AS RP ON RP.request_id = PR.request_id
                                            WHERE PR.session_id = $User_id "; 
                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $request_id = $row['request_id'];
                                                    $request_status = $row['request_status'];
                                                    echo "<tr>";
                                                    
                                                    // Add a checkbox for each product
                                                    echo "<td><input type='checkbox' class='product-checkbox' value='" . $request_id . "'></td>";
                                                    
                                                    // Display product details
                                                    // echo "<td><img src='../admin/process/" . $row['qr_code_path'] . "' alt='QR Code' width='100' height='150'></td>";
                                                  
                                                    echo "<td>" . htmlspecialchars($row['request_id']) . "</td>";
                                                    echo "<td>"  .$request_status ."</td>";
                                                    echo "<td>" . date("d-m-Y", strtotime($row['request_date'])) . "</td>";
                                
                                                    echo "<td>
                                                        
                                                        <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#archiveModal$request_id'>View Request</button>
                                                    </td>";
                                                    echo "</tr>";


                                                              // List of product Request
                                                              echo "<div class='modal fade' id='archiveModal$request_id' tabindex='-1' aria-labelledby='archiveModalLabel' aria-hidden='true'>
                                                              <div class='modal-dialog modal-xl'>
                                                                  <div class='modal-content'>
                                                                      <div class='modal-header'>
                                                                          <h5 class='modal-title' id='archiveModalLabel'>List of Products</h5>
                                                                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                      </div>
                                                                      <div class='modal-body'>

                                                                     Request Status : $request_status 

                                                                     
                                                                      <div class='modal-footer'>
                                                                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                                                          <a href='process/archive_product.php?id=$request_id' class='btn btn-danger'>Archive</a>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>";


                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>No products found</td></tr>";
                                            }
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
            $('#affiliateTable').DataTable({
                "order": [[7, "desc"]] // Orders by the first column (Date) in descending order
            }); // Initialize DataTables
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
