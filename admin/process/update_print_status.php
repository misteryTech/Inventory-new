<?php
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['date_approved'])) {
    $date_approved = mysqli_real_escape_string($conn, $_POST['date_approved']);

    if (!empty($date_approved)) {
        // Update print count for all records with the same date_approved
        $updateQuery = "UPDATE approved_products SET `print` = `print` + 1 WHERE date_approved = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "s", $date_approved);

        if (mysqli_stmt_execute($stmt)) {
            echo "✅ Print count updated successfully for date: $date_approved";
        } else {
            echo "❌ Error updating print count: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "⚠️ Invalid date provided.";
    }
} else {
    echo "⛔ Invalid request.";
}
?>
