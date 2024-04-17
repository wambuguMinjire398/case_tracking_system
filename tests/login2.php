<?php
// start session
session_start();
if (isset($_SESSION['user'])) header('Location: dashboard.php');

$error_message = '';
    if ($_POST) {
        include('../database/connect.php');

        // var_dump($_POST);
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = 'SELECT * FROM users WHERE users.email = "'. $username .'" AND users.password="'. $password .'"';
        $stmt = $conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetchAll()[0];
            $_SESSION['user'] = $user;

            header('Location: dashboard.php');
        }
        else $error_message = 'Please ensure username and password are correct';

    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../CSS/login2.css" />
  </head>
  <body>
    <!-- error message -->
    <?php
        if (!empty($error_message)) { ?>
    <div id="errorMessage">
        <p><strong>Error:</strong> <?= $error_message ?></p>
    </div>
    <?php } ?>
<!-- -------------------------------- -->
    <div class="wrapper">
      <form action="">
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" placeholder="username" required />
          <i class="bx bx-user"></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="password" required />
          <i class="bx bx-lock-alt"></i>
        </div>
        <button type="submit" class="btn">Login</button>
      </form>
    </div>
  </body>
</html>
