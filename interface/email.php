<?php
include('../partials/side-top.php');
?>

<?php
// Check if user is logged in
if (!isset($_SESSION['user'])) {
    //  if user is not loggedin Redirect to login page
    header('Location: login.php');
    exit(); // Stop further execution
}

$user = $_SESSION['user'];
$logged_in_users = [$user];
$_SESSION['table'] = 'users';
$users = include('../include/add_user/show_users.php');

?>
<div class="dashboard_content_main">

<h1 class="section_header"><i class='bx bx-envelope' ></i>Email</h1>

<div class="dashboard_content">

<form action="../include/email/sendEmail.php" method= "post" class="appForm"
id="userAddForm" >

    <div class="appFormInputContainer">
    <label for="name">Name</label>
        <input type="text" class="appFormInput" name="name" id="name" required>
    </div>
    
    <div class="appFormInputContainer">
        <label for="email">email</label>
        <input type="email" class="appFormInput" name="email" id="email" required>
    </div>

    <div class="appFormInputContainer">
        <label for="subject">Subject</label>
        <input type="subject" class="appFormInput" name="subject" id="subject" required>
    </div>

    <div class="appFormInputContainer">
        <label for="message">Message</label>
        <textarea name="message" class="appFormInput" id="message" required></textarea>
    </div>

    <br>

    <button type="submit" class="appbtn">
        <i class='bx bx-envelope' ></i> Send Email</button>

</form>

<?php include('../partials/side-bot.php'); ?>

</body>
</html>