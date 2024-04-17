<?php
include('../connect/connect.php');

$query = "SELECT * FROM adddoc ORDER BY activityDate DESC";
$result = $conn->query($query);

if ($result) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $result->free();
    return $data;
} else {
    // Handle query error
    echo "Error: " . $conn->error;
}

$conn->close();
?>
