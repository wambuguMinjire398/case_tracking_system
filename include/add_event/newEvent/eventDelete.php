<?php
require_once '../connect/conn.php'; // Assuming this file contains your database connection

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Prepare SQL statement
    $stmt = $conn->prepare("DELETE FROM class_list WHERE id = ?");

    // Bind parameter and execute statement
    $stmt->bind_param('i', $id); // Assuming 'id' is an integer, adjust if needed
    if ($stmt->execute()) {
        header('location: ../move_event.php');
    } else {
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}
?>
