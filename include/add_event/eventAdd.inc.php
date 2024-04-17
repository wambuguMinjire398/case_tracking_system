<?php
// Start session
session_start();

// Retrieve form data
$table_name = $_SESSION['table'];
$caseNumber = $_POST['caseNumber'];
$activity = $_POST['activity'];
$activityDate = $_POST['activityDate'];
$court = $_POST['court'];
$action_to = $_POST['action_to'];
$outcome = $_POST['outcome'];
$comments = $_POST['comments']; // Retrieve textarea value

// Add Event
include('../connect/conn.php');

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO $table_name (caseNumber, activity, activityDate, court, action_to, outcome, comments) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Bind parameters and execute statement
$stmt->bind_param('sssssss', $caseNumber, $activity, $activityDate, $court, $action_to, $outcome, $comments);
if ($stmt->execute()) {
    $response = [
        'success' => true,
        'message' => $caseNumber . ' ' . $citation . ' successfully added to the system.'
    ];
} else {
    $response = [
        'success' => false,
        'message' => $conn->error
    ];
}

// Close statement and database connection
$stmt->close();
$conn->close();

$_SESSION['response'] = $response;
header('location: ../move_event.php');

?>
