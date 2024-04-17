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

$_SESSION['table'] = 'new_case';
$user = $_SESSION['user'];
$logged_in_users = [$user];
$users = include('../include/add_user/show_users.php');
$case = include('../include/docHandling/showCase.php');
?>


      <!-- start -->
          <div class="dashboard_content_main">
          <h1 class="section_header"><i class="fa fa-plus"></i>Create New Case</h1>

            <div id="userAddForm">
              <form action="../include/docHandling/addNewCase.inc.php" method="POST" class="appForm" id="userAddForm">
              
              <div class="appFormInputContainer">
                    <label for="caseNumber">Case Number</label>
                    <input type="text" class="appFormInput" id = "caseNumber" name="caseNumber">
                </div>
              
                <div class="appFormInputContainer">
                      <label for="courtType">Court Rank</label>
                      <select id="courtType" name="courtType" class="form-select">
                      <option disabled selected>Select Court Rank</option>
                          <option value="Supreme Court">Supreme Court</option>
                          <option value="Court of Appeal">Court of Appeal</option>
                          <option value="High Court">High Court</option>
                          <option value="Environment and Land Court">Environment and Land Court</option>
                          <option value="Magistrate Court">Magistrate Court</option>
                      </select>
                  </div>

                  <div class="appFormInputContainer">
                      <label for="caseType">Case type</label>
                      <select id="caseType" name="caseType" class="form-select">
                      <option disabled selected>Select Case Type</option>
                          <option value="MCCR-Criminal Case">MCCR - Criminal Case</option>
                          <option value="MCSO-Sexual Offence">MCSO - Sexual Offence Case</option>
                          <option value="MCTR-Traffic Case">MCTR - Traffic Case</option>
                          <option value="MMCC-Civil Case">MMCC - Civil Case</option>
                          <option value="Protection & Care Case">Protection & Care Case</option>
                          <option value="Environment and land case">Environment and land case</option>
                          <option value="Succession Case">Succession Case</option>
                          <option value="Divorce case">Divorce case</option>
                          <option value="Children Case">Children Case</option>
                      </select>
                  </div>

                <div class="appFormInputContainer">
                    <label for="citation">Citation</label>
                    <input type="text" class="appFormInput" id = "citation" name="citation">
                </div>
                

                <!-- <input type="hidden" name="table" value="asdf"> -->
                <button type="submit" class="appbtn"><i class="fa fa-plus"></i> Add Case</button>
               
              </form>
              <?php
              if (isset($_SESSION['response'])) {
                
                $response_message = $_SESSION['response']['message'];
                $is_success = $_SESSION['response']['success'];
                ?>
                
                <div class= "responseMessage">
                  <p class="<?= $is_success ? 'responseMessage_success' : 'responseMessage_error'?>">
                      <?= $response_message?>
                  </p>
                </div>
              <?php unset($_SESSION['response']); } ?>
            
            </div> 


       <h1 class="section_header"><i class="fa fa-plus"></i>Case list</h1>
          <div class="users">
            <table>
            <thead>
                <th>Case Number</th>
                <th>Court Type</th>
                <th>Case Type</th>
                <th>Citation</th>
                <th>Created At</th>
               
                <th>Action</th>
            </thead>
            <tbody>
    <?php
    include('../connect/connect.php');
    // Read from the database table
    $sql = "SELECT * FROM new_case";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Invalid query: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $row["caseNumber"]; ?></td>
            <td><?php echo $row["courtType"]; ?></td>
            <td><?php echo $row["caseType"]; ?></td>
            <td><?php echo $row["citation"]; ?></td>
            <td><?php echo $row["created_at"]; ?></td>
            
            <td>
                <!-- decline -->
                <a class='btn btn-danger' name='decline' value='decline' href='../include/docHandling/deleteCase.php?delete=<?php echo $row['caseNumber']; ?>'>delete </a>
            </td>
        </tr>
    <?php
    }
    ?>
</tbody>

        </table>

  </div>
  <?php include('../partials/side-bot.php'); ?>       

  </body>
</html>
