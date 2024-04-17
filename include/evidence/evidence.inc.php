<?php
// Start session
session_start();

// Get table name from session
$table_name = $_SESSION['table'];

// Get form data
$caseNumber = $_POST['caseNumber'];
$activityDate = $_POST['date'];

// Check if image was uploaded
if (!empty($_FILES['uploadfile']['name'])) {
    // Image upload logic
    $image_name = $_FILES['uploadfile']['name'];
    $image_tmp_name = $_FILES['uploadfile']['tmp_name'];
    $image_size = $_FILES['uploadfile']['size'];
    
    // Move image to upload directory
    if (!move_uploaded_file($image_tmp_name, "upload/" . $image_name)) {
        // Image upload failed
        $response = [
            'success' => false,
            'message' => 'Failed to upload image file.'
        ];
        $_SESSION['response'] = $response;
        header('location: ../move_evidence.php');
        exit();
    }
} else {
    // No image uploaded
    $image_name = null; // Set image name to null
}

// Check if PDF was uploaded
if (!empty($_FILES['pdf']['name'])) {
    // PDF upload logic
    $pdf_name = $_FILES['pdf']['name'];
    $pdf_tmp_name = $_FILES['pdf']['tmp_name'];
    $pdf_size = $_FILES['pdf']['size'];
    
    // Move PDF to upload directory
    if (!move_uploaded_file($pdf_tmp_name, "upload/" . $pdf_name)) {
        // PDF upload failed
        $response = [
            'success' => false,
            'message' => 'Failed to upload PDF file.'
        ];
        $_SESSION['response'] = $response;
        header('location: ../move_evidence.php');
        exit();
    }
} else {
    // No PDF uploaded
    $pdf_name = null; // Set PDF name to null
}

// Include database connection
include('../connect/conn.php');

// Add evidence
$stmt = $conn->prepare("INSERT INTO $table_name (caseNumber, date, image, doc) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $caseNumber, $activityDate, $image_name, $pdf_name);

if ($stmt->execute()) {
    $response = [
        'success' => true,
        'message' => $caseNumber . ' successfully added to the system.'
    ];
} else {
    $response = [
        'success' => false,
        'message' => $stmt->error
    ];
}

$stmt->close();

$_SESSION['response'] = $response;
header('location: ../move_evidence.php');
exit();
