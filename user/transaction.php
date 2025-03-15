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
                                <h4 class="card-title">Transfer Item</h4>
                            
                                
                                <!-- Button to print selected products -->
                            
                         
                                <div class="table-responsive">
                                    <table class="table table-striped" id="affiliateTable">
                                        <thead>
                                            <tr>
                                
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Condition</th>
                                                <th>Remarks</th>
                                                <th>Release By</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Query to fetch products and barcode
                                            $query = "SELECT PR.*, PR.status AS request_status, RP.* , P.* , RP.status AS RP_status
                                            
                                            
                                            FROM product_requests AS PR
                                            INNER JOIN request_products AS RP ON RP.request_id = PR.request_id
                                            LEFT JOIN products AS P ON P.batch_number =  RP.product_id

                                            WHERE PR.session_id = $User_id  AND RP.remarks= 'Transferred'"; 
                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $request_id = $row['request_id'];
                                                        $quantity = $row['quantity'];
                                                        $product_condition = $row['product_condition'];
                                                        $product_name = $row['product_name'];
                                                        $RP_status = $row['RP_status'];
                                                        $approved1 = $row['approved1'];
                                                        $release_id = $row['release_form'];
                                                        $remarks = $row['remarks'];
                                                        $request_date = date("d-m-Y", strtotime($row['request_date']));
                                                
                                                        echo "<tr>";
                                                      
                                                   
                                                        echo "<td>" . htmlspecialchars($product_name) . "</td>";
                                                        echo "<td>" . htmlspecialchars($quantity) . "</td>";
                                                        echo "<td>" . htmlspecialchars($product_condition) . "</td>";
                                              
                                                        echo "<td>" . $remarks . "</td>";
                                                         echo "<td>" . (!empty($approved1) ? $approved1 : "Not yet Viewed") . "</td>";
                                                        // echo "<td>
                                                        //         <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#archiveModal$request_id'>View Request</button>
                                                        //       </td>";
                                                        echo "</tr>";
                                                
                                                        // Modal for each request
                                                        echo "<div class='modal fade' id='archiveModal$request_id' tabindex='-1' aria-labelledby='archiveModalLabel' aria-hidden='true'>
                                                                <div class='modal-dialog modal-s'>
                                                                    <div class='modal-content'>
                                                                        <div class='modal-header'>
                                                                            <h5 class='modal-title'>Product Information</h5>
                                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                        </div>
                                                                        <div class='modal-body'>";
                                                
                                                     // Request status logic
if (!empty($RP_status)) {
    if ($RP_status == 'Onprocess') {
        echo "<h2>Request Status: Onprocess</h2>";
        echo "<p>The product is currently under review by head management. An update will be provided once the request is added to the release list.</p>";                                                                
    } elseif ($RP_status == 'Declined') {
        echo "<h2>Request Status: Declined</h2>";
        echo "<p>The request has been declined because the admin won't be able to purchase the requested item.</p>";
    } elseif ($RP_status == 'Released') {
        echo "<h2>Request Status: Released</h2>";
        
        // Masked release ID (showing only last 4 digits)
        $masked_id = str_repeat('*', strlen($release_id) - 4) . substr($release_id, -4);
        
        echo "<p>Please Present this Release No.:</p>";
        echo "<p id='releaseId'>$masked_id</p>";
        
        // Buttons to toggle view and generate QR code
        echo "<button class='btn btn-success' onclick='toggleView()'>View</button>"; 
        echo " ||";
        echo "<button class='btn btn-primary' onclick='generateQRCode(\"$release_id\")'>Print/QR Code</button>";

        // JavaScript for toggling visibility and QR Code generation
        echo "<script>
            let isMasked = true;
            function toggleView() {
                let releaseElement = document.getElementById('releaseId');
                if (isMasked) {
                    releaseElement.textContent = \"$release_id\"; // Show actual release ID
                } else {
                    releaseElement.textContent = \"$masked_id\"; // Show masked version
                }
                isMasked = !isMasked;
            }

            function generateQRCode(releaseId) {
                window.open('qrcode_generator.php?data=' + encodeURIComponent(releaseId), '_blank');
            }
        </script>";
    } else {
        echo "<h2>Request Status: " . htmlspecialchars($RP_status) . "</h2>";
    }
} else {
    echo "<p>The request product has not yet been viewed by the admin.</p>";
}

                                                
                                                        echo "          </div>
                                                                        <div class='modal-footer'>
                                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>";
                                                    }
                                                
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
