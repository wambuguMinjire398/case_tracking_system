<?php
// Start session
session_start();
if (isset($_SESSION['user'])) header('Location: dashboard.php');

$error_message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../connect/connect.php');

    $email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verify the provided password with the hashed password from the database
    if (password_verify($password, $user['password'])) {
        // Password is correct, proceed with login
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit();
    } else {
        $error_message = 'Please ensure email and password are correct';
    }
} else {
    $error_message = 'User not found';
}


    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS-Case Management System</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body id="loginBody">
    <?php if (!empty($error_message)) { ?>
        <div id="errorMessage">
            <p><strong>Error:</strong> <?= $error_message ?></p>
        </div>
    <?php } ?>

    <div class="container">
        <div class="loginHeader">
            <h1>CMS</h1>
            <p>Case Management System</p>
        </div>
        <div class="loginBody">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="loginInputsContainer">
                    <label for="username">Email</label>
                    <input type="text" name="email" placeholder="Username" />
                </div>
                <div class="loginInputsContainer">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" />
                </div>
                <div class="loginButtonContainer">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
