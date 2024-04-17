<?php
include('../partials/side-top.php');
?>

<?php
// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.php');
    exit(); // Stop further execution
}

$user = $_SESSION['user'];
$logged_in_users = [$user]; // Replace this with the actual logic to get logged-in users
?>

<div class="dashboard_content_main">
  <div class="dashboard_content">
    <h1 class="section_header"><i class="bx bx-user"></i>Logged-In Users</h1>  

    <div class="users">
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logged_in_users as $logged_in_user): ?>
                <tr>
                    <td><?= $logged_in_user['id'] ?></td>
                    <td><?= $logged_in_user['firstName'] ?></td>
                    <td><?= $logged_in_user['lastName'] ?></td>
                    <td><?= $logged_in_user['email'] ?></td>
                    <!-- Add more columns as needed -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
</div>


<?php include('../partials/side-bot.php'); ?>

  </body>
</html>
