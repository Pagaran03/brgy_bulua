<?php
// Set X-Frame-Options header to prevent clickjacking
header("X-Frame-Options: DENY");
// Include your database configuration file
include_once ('../../../config.php');

// Function to sanitize input
function sanitize_input($input)
{
    // Remove all HTML tags
    $input = strip_tags($input);
    return $input;
}

// Get data from the POST request and sanitize it
$description = sanitize_input($_POST['description']);
$title = sanitize_input($_POST['title']);
$date = date('Y-m-d'); // Adjust the format according to your needs
$time = date('H:i:s'); // Adjust the format according to your needs

$sql = "INSERT INTO announcements (description, title, date, time) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $description, $title, $date, $time);

if ($stmt->execute()) {
    // Successful insertion
    echo 'Success';
} else {
    // Error handling
    echo 'Error: ' . $conn->error;
}
$stmt->close();
$conn->close();
?>