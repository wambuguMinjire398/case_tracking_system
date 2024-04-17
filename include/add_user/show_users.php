<?php
include('../connect/connect.php');

// Prepare SQL statement
$sql = "SELECT * FROM users ORDER BY created_at DESC";

// Execute SQL statement
$result = $conn->query($sql);

// Check if query was successful
if ($result) {
    // Fetch data as associative array
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Free result set
    $result->free();

    // Return fetched data
    return $rows;
} else {
    // If query fails, handle the error (you might want to log or display it)
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
