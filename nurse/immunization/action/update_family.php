<?php
// Include your database configuration file
include_once ('../../../config.php');

// Function to sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

// Sanitize and filter POST data
$primary_id = sanitize_input($_POST['primary_id']);
$bgc_date = sanitize_input($_POST['bgc_date']);
$bgc_remarks = sanitize_input($_POST['bgc_remarks']);
$hepa_date = sanitize_input($_POST['hepa_date']);
$hepa_remarks = sanitize_input($_POST['hepa_remarks']);
$pentavalent_date1 = sanitize_input($_POST['pentavalent_date1']);
$pentavalent_date2 = sanitize_input($_POST['pentavalent_date2']);
$pentavalent_date3 = sanitize_input($_POST['pentavalent_date3']);
$pentavalent_remarks = sanitize_input($_POST['pentavalent_remarks']);
$oral_date1 = sanitize_input($_POST['oral_date1']);
$oral_date2 = sanitize_input($_POST['oral_date2']);
$oral_date3 = sanitize_input($_POST['oral_date3']);
$oral_remarks = sanitize_input($_POST['oral_remarks']);
$ipv_date1 = sanitize_input($_POST['ipv_date1']);
$ipv_date2 = sanitize_input($_POST['ipv_date2']);
$ipv_remarks = sanitize_input($_POST['ipv_remarks']);
$pcv_date1 = sanitize_input($_POST['pcv_date1']);
$pcv_date2 = sanitize_input($_POST['pcv_date2']);
$pcv_date3 = sanitize_input($_POST['pcv_date3']);
$pcv_remarks = sanitize_input($_POST['pcv_remarks']);
$mmr_date1 = sanitize_input($_POST['mmr_date1']);
$mmr_date2 = sanitize_input($_POST['mmr_date2']);
$mmr_remarks = sanitize_input($_POST['mmr_remarks']);

// Remove HTML tags
$bgc_remarks = strip_tags($bgc_remarks);
$hepa_remarks = strip_tags($hepa_remarks);
$pentavalent_remarks = strip_tags($pentavalent_remarks);
$oral_remarks = strip_tags($oral_remarks);
$ipv_remarks = strip_tags($ipv_remarks);
$pcv_remarks = strip_tags($pcv_remarks);
$mmr_remarks = strip_tags($mmr_remarks);

try {
    // Start a transaction
    $conn->begin_transaction();

    $immunizationUpdateSql = "UPDATE immunization SET bgc_date=?, bgc_remarks=?, hepa_date=?, hepa_remarks=?, pentavalent_date1=?, pentavalent_date2=?, pentavalent_date3=?, pentavalent_remarks=?, oral_date1=?, oral_date2=?, oral_date3=?, oral_remarks=?, ipv_date1=?, ipv_date2=?, ipv_remarks=?, pcv_date1=?, pcv_date2=?, pcv_date3=?, pcv_remarks=?, mmr_date1=?, mmr_date2=?, mmr_remarks=? WHERE id=?";
    $immunizationStmt = $conn->prepare($immunizationUpdateSql);
    $immunizationStmt->bind_param("ssssssssssssssssssssssi", $bgc_date, $bgc_remarks, $hepa_date, $hepa_remarks, $pentavalent_date1, $pentavalent_date2, $pentavalent_date3, $pentavalent_remarks, $oral_date1, $oral_date2, $oral_date3, $oral_remarks, $ipv_date1, $ipv_date2, $ipv_remarks, $pcv_date1, $pcv_date2, $pcv_date3, $pcv_remarks, $mmr_date1, $mmr_date2, $mmr_remarks, $primary_id);

    // Execute the update statement
    $immunizationUpdateSuccess = $immunizationStmt->execute();

    if ($immunizationUpdateSuccess) {
        // Commit the transaction if the update is successful
        $conn->commit();
        echo 'Success';
    } else {
        // Rollback the transaction if the update fails
        $conn->rollback();
        throw new Exception('Error updating data');
    }

    // Close the prepared statement
    $immunizationStmt->close();

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Handle exceptions (e.g., log the error and provide a user-friendly message)
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error: ' . $e->getMessage();
}
?>