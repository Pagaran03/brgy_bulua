<?php
// Include your database configuration file
include_once ('../../../config.php');

// Function to sanitize input
function sanitize_input($input)
{
    // Remove all HTML tags
    $input = strip_tags($input);
    return $input;
}

// Get updated patient data from the POST request and sanitize it
$patientId = sanitize_input($_POST['patient_id']);
$description = sanitize_input($_POST['description']);
$title = sanitize_input($_POST['title']);
$date = date('Y-m-d'); // Adjust the format according to your needs
$time = date('H:i:s'); // Adjust the format according to your needs

try {
    // Update patient data in the database
    $sql = "UPDATE announcements SET description=?, title=?, date=?, time=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $description, $title, $date, $time, $patientId);

    if ($stmt->execute()) {
        // Successful update
        echo 'Success';
    } else {
        throw new Exception('Error updating patient: ' . $stmt->error);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    // Handle exceptions (e.g., log the error and provide a user-friendly message)
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error: ' . $e->getMessage();
}
?>