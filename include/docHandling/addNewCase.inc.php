<?php
// Start session
session_start();

// Get table name from session
$table_name = $_SESSION['table'];

// Get form data
$caseNumber = $_POST['caseNumber'];
$courtType = $_POST['courtType'];
$caseType = $_POST['caseType'];
$citation = $_POST['citation'];

// Include database connection
include('../connect/conn.php');

// Add case
try {
    // Get current date and time
    $currentDateTime = date('Y-m-d H:i:s');

    // Prepare SQL statement
    $command = "INSERT INTO $table_name (caseNumber, courtType, caseType, citation, created_at)
                VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($command);
    $stmt->bind_param("sssss", $caseNumber, $courtType, $caseType, $citation, $currentDateTime);
    
    // Execute SQL statement
    $stmt->execute();

    // Check if insertion was successful
    if ($stmt->affected_rows > 0) {
        $response = [
            'success' => true,
            'message' => $caseNumber.' '.$citation.' successfully added to the system.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to add case.'
        ];
    }

    // Close statement
    $stmt->close();

} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

// Store response in session
$_SESSION['response'] = $response;

// Redirect to addNewCase.php page
header('location: ../move_case.php');
?>
