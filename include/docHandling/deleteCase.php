<?php
require_once '../connect/conn.php';

if (isset($_GET['delete'])) {
    $caseNumber = $_GET['delete'];

    // Prepare SQL statement
    $stmt = $conn->prepare("DELETE FROM new_case WHERE caseNumber = ?");
    $stmt->bind_param('s', $caseNumber);

    // Execute prepared statement
    if ($stmt->execute()) {
        header('location: ../move_case.php');
    } else {
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}
?>
