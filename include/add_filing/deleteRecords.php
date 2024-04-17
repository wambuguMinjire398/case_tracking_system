<?php
$response = ['success' => false, 'message' => ''];

if (isset($_GET['delete'])) {
    require_once '../connect/conn.php';

    $id = $_GET['delete']; // Corrected variable name

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM adddoc WHERE id = ?");
    $stmt->bind_param('i', $id); // 'i' indicates integer type

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Record deleted successfully.';
    } else {
        $response['message'] = "Error: " . $conn->error;
    }

    $stmt->close(); 
}

// Output the response as JSON
echo json_encode($response);

// header('location: ../move_record.php');

?>
