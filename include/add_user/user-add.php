<?php
// Start session
session_start();

// Get table name from session
$table_name = $_SESSION['table'];

// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password']; // Plain text password
$encrypted_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
$level = $_POST['level'];

// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cms1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if connection is successful
if (!$conn) {
    $response = [
        'success' => false,
        'message' => 'Failed to connect to the database.'
    ];
    $_SESSION['response'] = $response;
    header('location: ../move_user.php');
    exit;
}

// Add user
try {
    // Get current date and time
    $currentDateTime = date('Y-m-d H:i:s');

    // Prepare SQL statement
    $command = "INSERT INTO $table_name (firstName, lastName, email, password, created_at, level)
        VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($command);
    
    // Check if prepare was successful
    if (!$stmt) {
        $response = [
            'success' => false,
            'message' => 'Failed to prepare SQL statement.'
        ];
        $_SESSION['response'] = $response;
        header('location: ../move_user.php');
        exit;
    }

    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $encrypted_password, $currentDateTime, $level);
    
    // Execute SQL statement
    $stmt->execute();

    // Check if insertion was successful
    if ($stmt->affected_rows > 0) {
        $response = [
            'success' => true,
            'message' => $firstName.' '.$lastName.' successfully added to the system.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to add user.'
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

// Redirect to add-user.php page
header('location: ../move_user.php');
exit; 
?>
