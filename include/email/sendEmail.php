<?php
// Include database connection
include('../connect/conn.php');

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Query the database to get recipient's email address based on the name
$query = "SELECT email FROM users WHERE CONCAT(firstName, ' ', lastName) = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$recipientEmail = $row['email'];

// Send email
$to = $recipientEmail;
$headers = "From: your_email@example.com\r\n";
$headers .= "Reply-To: your_email@example.com\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$mailBody = "<html><body>";
$mailBody .= "<h2>$subject</h2>";
$mailBody .= "<p>$message</p>";
$mailBody .= "</body></html>";

$mailSent = mail($to, $subject, $mailBody, $headers);

if ($mailSent) {
    // Email sent successfully
    // Insert the message into the database
    $senderId = $_SESSION['user']['id'];
    $query = "INSERT INTO messages (sender_id, recipient_id, subject, body) VALUES (?, (SELECT id FROM users WHERE CONCAT(firstName, ' ', lastName) = ?), ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $senderId, $name, $subject, $message);
    $stmt->execute();
    // Redirect or display success message
} else {
    // Failed to send email
    // Redirect or display error message
}
?>
