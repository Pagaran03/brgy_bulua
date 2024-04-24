<?php
// Include your database configuration file
include_once ('../../../config.php');

// Sanitize input data
$primary_id = strip_tags($_POST['primary_id']);
$latestcheckup_date = strip_tags($_POST['latestcheckup_date']);
$diagnosis = strip_tags($_POST['diagnosis']);
$medicine = strip_tags($_POST['medicine']);

try {
    // Start a transaction
    $conn->begin_transaction();

    // Update SQL statement for consultations
    $consultationUpdateSql = "UPDATE consultations SET latestcheckup_date=?, diagnosis=?, medicine=? WHERE id=?";
    $consultationStmt = $conn->prepare($consultationUpdateSql);
    $consultationStmt->bind_param("sssi", $latestcheckup_date, $diagnosis, $medicine, $primary_id);

    // Execute the update statement
    $consultationUpdateSuccess = $consultationStmt->execute();

    if ($consultationUpdateSuccess) {
        // Commit the transaction if the update is successful
        $conn->commit();
        echo 'Success';
    } else {
        // Rollback the transaction if the update fails
        $conn->rollback();
        throw new Exception('Error updating data');
    }

    // Close the prepared statement
    $consultationStmt->close();

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Handle exceptions (e.g., log the error and provide a user-friendly message)
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error: ' . $e->getMessage();
}
?>