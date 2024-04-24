<?php
// Include your database configuration file
include_once ('../../../config.php');
session_start();

// Get data from the POST request and sanitize it
$patient_id = strip_tags($_POST['patient_id']);
$subjective = strip_tags($_POST['subjective']);
$objective = strip_tags($_POST['objective']);
$assessment = strip_tags($_POST['assessment']);
$plan = strip_tags($_POST['plan']);
$diagnosis = strip_tags($_POST['diagnosis']);
$medicine = strip_tags($_POST['medicine']);
$latestcheckup_date = date('latestcheckup_date');
$doctor_id = strip_tags($_POST['doctor_id']);

$sql = "INSERT INTO consultations (patient_id, subjective, objective, assessment, plan, diagnosis, medicine, latestcheckup_date, doctor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $patient_id, $subjective, $objective, $assessment, $plan, $diagnosis, $medicine, $latestcheckup_date, $doctor_id);

if ($stmt->execute()) {
    // Successful insertion
    echo 'Success';
} else {
    // Error handling
    echo 'Error: ' . $conn->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>