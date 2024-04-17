<?php
require_once '../connect/conn.php';

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    // Delete user using MySQLi
    $result = $conn->query("DELETE FROM users WHERE id = $id");

    if ($result) {
        // Redirect to add-user.php page
        header('location: ../move_user.php');
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
