<?php
// Include your database configuration file
include_once ('../../../config.php');

// Function to sanitize input and remove HTML tags
function sanitize_input($data)
{
    $data = trim(strip_tags($data));
    $data = stripslashes($data);
    return $data;
}

// Sanitize input data
$primary_id = sanitize_input($_POST['primary_id']);
$method = sanitize_input($_POST['method']);
$description = sanitize_input($_POST['description']);
$diagnosis = sanitize_input($_POST['diagnosis']);
$medicine = sanitize_input($_POST['medicine']);

try {
    // Start a transaction
    $conn->begin_transaction();

    // Prepare and bind parameters for consultation update
    $consultationUpdateSql = "UPDATE fp_consultation SET method=?, description=?, diagnosis=?, medicine=? WHERE id=?";
    $consultationStmt = $conn->prepare($consultationUpdateSql);
    $consultationStmt->bind_param("ssssi", $method, $description, $diagnosis, $medicine, $primary_id);

    // Execute consultation update
    $consultationUpdateSuccess = $consultationStmt->execute();

    if ($consultationUpdateSuccess) {
        // Commit the transaction if successful
        $conn->commit();
        echo 'Success';
    } else {
        // Rollback the transaction if update fails
        $conn->rollback();
        throw new Exception('Error updating data');
    }

    // Close prepared statements
    $consultationStmt->close();

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Handle exceptions (e.g., log the error and provide a user-friendly message)
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error: ' . $e->getMessage();
}
?>