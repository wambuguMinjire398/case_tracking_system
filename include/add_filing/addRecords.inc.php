<?php

// start session
session_start();
$table_name = $_SESSION['table'];
$caseNumber = $_POST['caseNumber'];
$citation = $_POST['citation'];
$activityDate = $_POST['activityDate'];

// pdf
$pdf = $_FILES['pdf']['name'];
$pdf_type = $_FILES['pdf']['type'];
$pdf_size = $_FILES['pdf']['size'];
$pdf_tem_loc = $_FILES['pdf']['tmp_name'];
$pdf_store = "pdf/" . $pdf;

move_uploaded_file($pdf_tem_loc, $pdf_store);

// Add case
include('../connect/conn.php'); // Assuming this file contains the database connection

$response = [];

// Prepare and bind parameters
$stmt = $conn->prepare("INSERT INTO $table_name (caseNumber, citation, activityDate, roughDoc) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $caseNumber, $citation, $activityDate, $pdf);

// Execute the statement
if ($stmt->execute()) {
    $response = [
        'success' => true,
        'message' => $caseNumber . ' ' . $citation . ' successfully added to the system.'
    ];
} else {
    $response = [
        'success' => false,
        'message' => $stmt->error
    ];
}

$stmt->close();

$_SESSION['response'] = $response;
header('location: ../move_record.php');
?>
