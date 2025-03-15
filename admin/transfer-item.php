<?php
include 'connection.php'; // Database connection file

if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];
    
    // Prepare the update query to set 'remarks' and 'date_claim'
    $query = "UPDATE request_products SET remarks = 'Transferred', date_claim = NOW() WHERE request_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $request_id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $message = "Item Succesfully Transfered and Recorded!";
            } else {
                $message = "Error: No matching request found or already updated.";
            }
        } else {
            $message = "Execution failed: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Preparation failed: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    // Show alert and go back
    echo "<script>
            alert('$message');
            window.history.back();
          </script>";
} else {
    echo "<script>
            alert('Error: request_id is missing.');
            window.history.back();
          </script>";
}
?>
