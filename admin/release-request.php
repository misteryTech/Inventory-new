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
                                <h4 class="card-title">Release Request</h4>
               
                                
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> Username </th>
                                                <th> Request Date </th>
                                                <th> Status </th>
                                                <th> Remarks </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
$query = "SELECT PR.*, U.* , RP.* , PR.status AS status_pr
          FROM product_requests AS PR
          INNER JOIN users AS U ON U.id = PR.session_id 
          INNER JOIN  request_products AS RP ON RP.request_id = PR.request_id


          WHERE PR.status = 'Released' 
          ORDER BY request_date DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $request_id = $row['request_id'];
        $username = htmlspecialchars($row['username']);
        $request_date = htmlspecialchars($row['request_date']);
        $status = htmlspecialchars($row['status_pr']);
        $remarks = htmlspecialchars($row['remarks']);
        $release_id = htmlspecialchars($row['release_form']); // Assuming this column stores the generated release number

        echo "<tr>";
        echo "<td>$username</td>";
        echo "<td>$request_date</td>";
        echo "<td>$status</td>";
        echo "<td>" . (!empty($remarks) ? $remarks : "<span style='color: red; font-weight: bold;'>Not yet claimed</span>") . "</td>";
        echo "<td>";
        echo ($remarks !== "Transferred") 
        ? "<button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#verifyModal$request_id'>Enter Release Number</button>" 
        : "";
        echo "</td>";
        echo "</tr>";

        // Modal for entering the release number
        echo "<div class='modal fade' id='verifyModal$request_id' tabindex='-1' aria-labelledby='verifyModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='verifyModalLabel'>Verify Release Number</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <p><strong>Username:</strong> $username</p>
                            <p><strong>Request Date:</strong> $request_date</p>
                            <p><strong>Status:</strong> $status</p>
                            <label for='releaseNumberInput$request_id'>Enter Release Number:</label>
                            <input type='text' id='releaseNumberInput$request_id' class='form-control' placeholder='Enter Release Number'>
                            <div id='transferButtonContainer$request_id' style='display:none; margin-top:10px;'>
                                <a href='transfer-item.php?request_id=$request_id' class='btn btn-success'>Transfer Item</a>
                            </div>
                            <p id='errorMsg$request_id' style='color:red; display:none;'>Incorrect Release Number.</p>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='button' class='btn btn-primary' onclick='checkReleaseNumber($request_id, \"$release_id\")'>Verify</button>
                        </div>
                    </div>
                </div>
              </div>";
    }
} else {
    echo "<tr><td colspan='4'>No users found</td></tr>";
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
</body>


<script>
    
function checkReleaseNumber(request_id, correctReleaseId) {
    let inputField = document.getElementById('releaseNumberInput' + request_id);
    let errorMsg = document.getElementById('errorMsg' + request_id);
    let transferButtonContainer = document.getElementById('transferButtonContainer' + request_id);

    if (inputField.value === correctReleaseId) {
        errorMsg.style.display = 'none';
        transferButtonContainer.style.display = 'block';
    } else {
        errorMsg.style.display = 'block';
        transferButtonContainer.style.display = 'none';
    }
}
</script>