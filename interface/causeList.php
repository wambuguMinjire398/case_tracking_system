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
$_SESSION['table'] = 'adddoc';
$users = include('../include/add_user/show_users.php');
?>

<div class="dashboard_content_main">
<div>
<!-- course List -->
<h1 class="section_header"><i class="fa fa-search"></i>Generate by course list:</h1>
<form action="../include/generate_pdf/course_list/courseList.php" 
      method="POST" class="appForm">

      <div class="appFormInputContainer">
        <label for="court">Court Room</label>
        <select name="court" id ="court" class="form-control">
        <option disabled selected>Select Court Room</option>
            <option value="Court 1">Court 1</option>
            <option value="Court 2">Court 2</option>
            <option value="Court 3">Court 3</option>
            <option value="Court 4">Court 4</option>
            <option value="Court 5">Court 5</option>
        </select>
    </div>


    <div class="appFormInputContainer">
        <label for="">Generate by date</label>
        <input type="date" name="search" placeholder="Generate by date" class="form-control" />
    </div>
    <button type="submit" class="appbtn"><i class='bx bxl-magento'></i> Generate</button>
</form>
</div>

<?php include('../partials/side-bot.php'); ?>

</body>
</html>
