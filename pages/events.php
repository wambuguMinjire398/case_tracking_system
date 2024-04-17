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
?>


    <div class="container1">
      <div class="row">
        <div class="col">
          <h1>Transcripts</h1>
          <!-- <p>working with transcripts</p> -->

          <!-- <button type="button">Explore</button> -->
        </div>

        <div class="col">
        <a href="../interface/eventAdd.php">
        <div class="card card1">
            <h5>Past</h5>
            <h5>Events</h5>
            <!-- <p>Lorem ipsum dolor</p> -->
          </div>
        </a>
          

        <a href="../interface/newEvent.php">
          <div class="card card2">
            <h5>Upcoming</h5>
            <h5>Events</h5>
            <!-- <p>Lorem ipsum dolor</p> -->
          </div>
        </a>

        </div>
      </div>
    </div>

    <?php include('../partials/side-bot.php'); ?>
  </body>
</html>
