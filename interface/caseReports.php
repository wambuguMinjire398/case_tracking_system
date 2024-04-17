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


<div >
<!-- Case Report
<h1 class="section_header"><i class="fa fa-search"></i>Generate Case information:</h1>
<form action="../include/generate_pdf/caseReport/caseReport.php" method="POST" class="appForm">
    <div class="appFormInputContainer">
        <label for="">Generate by Case Number</label>
        <input type="text" name="caseNumber" placeholder="Generate by case number" class="form-control" />
    </div>
    <button type="submit" class="appbtn"><i class='bx bxl-magento'></i> Generate</button>
</form>
<a href="../include/generate_pdf/cases/casesPDF.php" class='btn btn-primary'>Generate all cases</a>
</div> -->

<!-- new search -->
<form action="../include/generate_pdf/caseReport/caseReport.php" method="POST" class="appForm">
    <div class="appFormInputContainer">
    <label for="">Generate by Case Number</label>

      <!-- Text input field -->
      <input type="text" name="caseNumber" placeholder="Generate by case number" class="form-control" />
      <!-- dropdown list -->
        <select name="caseNumber" class="form-select">
          <option disabled selected>Select case number</option>            
          <?php
            // Read from the database table to populate the select options
            $sql = "SELECT DISTINCT caseNumber FROM new_case ORDER BY caseNumber";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Invalid query: " . $conn->error);
            }
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['caseNumber'] . '">' . $row['caseNumber'] . '</option>';
            }
            ?>
        </select>
        <button type="submit" class="appbtn"><i class='bx bxl-magento'></i> Generate</button>
    
</form>
</div>
<a href="../include/generate_pdf/cases/casesPDF.php" class='btn btn-primary'>Generate all cases</a>

<?php include('../partials/side-bot.php'); ?>

</body>
</html>
