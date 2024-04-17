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
$_SESSION['table'] = 'events';
$users = include('../include/add_user/show_users.php');
// $doc = include('../include/add_event/showEvent.php');
?>





          <!-- start -->
          <div class="dashboard_content_main">
            
          <div class="dashboard_content" style="">
          <h1 class="section_header"><i class="fa fa-plus"></i>Add new event</h1>
              <form action="../include/add_event/eventAdd.inc.php" 
              method="POST" 
              enctype="multipart/form-data"
              class="appForm">
              <div class="appFormInputContainer">
                    <label for="caseNumber">Case Number</label>
                    <input type="text"
                     class="appFormInput" 
                     id = "caseNumber" 
                     name="caseNumber">
                </div>
              
                <div class="appFormInputContainer">
                    <label for="activity">Activity</label>
                    <input type="text"
                     class="appFormInput" 
                     id = "activity" 
                     name="activity">
                </div>

                <div class="appFormInputContainer">
                    <label for="activityDate">Activity Date</label>
                    <input type="date"
                     class="appFormInput" 
                     id = "activityDate" 
                     name="activityDate">
                </div>
                <div class="appFormInputContainer">
                    <label for="court">Court Room</label>
                    <select class="form-select" id="court" name="court">
                      <option disabled selected>Select Court Room</option>
                        <option value="Court 1">Court 1</option>
                        <option value="Court 2">Court 2</option>
                        <option value="Court 3">Court 3</option>
                        <option value="Court 4">Court 4</option>
                        <option value="Court 5">Court 5</option>
                    </select>
                </div>

                <div class="appFormInputContainer">
                    <label for="action_to">Action to</label>
                    <input type="text"
                     class="appFormInput" 
                     id = "action_to" 
                     name="action_to">
                </div>
                <div class="appFormInputContainer">
                    <label for="outcome">Outcome</label>
                    <input type="text"
                     class="appFormInput" 
                     id = "outcome" 
                     name="outcome">
                </div>
                <div class="appFormInputContainer">
                    <label for="comments">Comments</label>
                    <textarea id="comments" name="comments"></textarea>
                </div>

                <!--upload button-->
                <button type="submit" class="appbtn"><i class="fa fa-plus"></i> Add Event</button>

               
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


<!-- serach bar -->
<h1 class="section_header"><i class="fa fa-search"></i>Search for a case to add records:</h1>
<form action="eventAdd.php" method="POST">
    <div class="input-group input-group-sm mb-3">
      <!-- Text input field -->
      <input type="text" name="search" placeholder="Search by Case Number" class="form-control" />

      <!-- dropdown list -->
        <select name="caseNumber" class="form-select">
          <option disabled selected>Select case number</option>            
          <?php
            // Read from the database table to populate the select options
            $sql = "SELECT DISTINCT caseNumber FROM events ORDER BY caseNumber";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Invalid query: " . $conn->error);
            }
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['caseNumber'] . '">' . $row['caseNumber'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Search" class="btn btn-outline-secondary" />
    </div>
</form>
          
<!-- trial table -->
<h1 class="section_header"><i class="fa fa-plus"></i>Case list</h1>

<?php
include '../connect/connect.php';
$search = $_POST['caseNumber'] ?? '';

// Read from the database table
$sql = "SELECT * FROM events WHERE caseNumber = '$search' ORDER BY caseNumber";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

$currentCaseNumber = null;

while ($row = $result->fetch_assoc()) {
    // Check if the caseNumber has changed
    if ($row["caseNumber"] != $currentCaseNumber) {
        // If it has, close the previous section and start a new one
        if ($currentCaseNumber !== null) {
            echo '</tbody></table><br><br>';
        }
        echo '<h2 class="section_header">Case Number: ' . $row["caseNumber"] . '</h2>';
        echo '<div class="users"><table >
            <thead>
                <th>Id.</th>
                <th>Case Number</th>
                <th>Activity</th>
                <th>activityDate</th>
                <th>Court</th>
                <th>Action to</th>
                <th>Outcome</th>
                <th>Comments</th>
                <th>Action</th>
                
            </thead>
            <tbody>';
        $currentCaseNumber = $row["caseNumber"];
    }
    ?>
    <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["caseNumber"]; ?></td>
        <td><?php echo $row["activity"]; ?></td>
        <td><?php echo $row["activityDate"]; ?></td>
        <td><?php echo $row["court"]; ?></td>
        <td><?php echo $row["action_to"]; ?></td>
        <td><?php echo $row["outcome"]; ?></td>
        <td><?php echo $row["comments"]; ?></td>
        <td>
            <a class='btn btn-danger delete-record' 
                data-record-id='<?php echo $row['id']; ?>'
                href='#'>delete</a>
        </td>
    </tr>
<?php
}

// Close the last section
if ($currentCaseNumber !== null) {
    echo '</tbody></table><br><br>';
}

// Close the database connection
$conn->close();
?>

        </div>
      </div>
    </div>

          </div>
            
          <script src = "../js/eventjs.js"></script>  

   
    <?php include('../partials/side-bot.php'); ?>       
   
  </body>
</html>
