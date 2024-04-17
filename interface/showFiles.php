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
$doc = include('../include/add_filing/showAdd.php');
?>



<div class="dashboard_content_main">
        <div class="dashboard_content">
          <!-- start -->
        <h1 class="section_header"><i class="fa fa-plus"></i>Case list</h1>
        <!-- view records button -->
        <div style="padding-bottom: 80px;">
        <h2 style="
                   font-size:21px;
                   color: #2b3641;
                   border: 1px solid #9e9e9e;
                   padding:8px;
                   border-left:4px solid #f685a1;
                    ">Records with no final transcripts</h2>
          <a href="../include/generate_pdf/case_doc_noFinal/casesDocPDF.php" class="btn btn-primary">Generate List</a>
        </div>
          
             

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

         
          
<!-- view documentation -->
<!-- <h1 class="section_header"><i class="fa fa-plus"></i>Case list</h1> -->
<!-- serach bar -->
<h1 class="section_header"><i class="fa fa-search"></i>Search for a case to add records:</h1>
<form action="showFiles.php" method="POST">
    <div class="input-group input-group-sm mb-3">
      <!-- Text input field -->
      <input type="text" name="search" placeholder="Search by Case Number" class="form-control" />

      <!-- dropdown list -->
        <select name="caseNumber" class="form-select">
          <option disabled selected>Select case number</option>            
          <?php
            // Read from the database table to populate the select options
            $sql = "SELECT DISTINCT caseNumber FROM adddoc ORDER BY caseNumber";
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


<?php
include('../connect/connect.php');

$search = $_POST['caseNumber'] ?? '';

// Read from the database table
$sql = "SELECT * FROM adddoc WHERE caseNumber = '$search' ORDER BY caseNumber";
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
        echo '<h1 class="section_header">Case Number: ' . $row["caseNumber"] . '</h1>';
        echo '<div class="users"><table>
            <thead>
                <th>Id.</th>
                
                <th>Citation</th>
                <th>activityDate</th>
                <th>Transcript</th>
                <th>Action</th>
            </thead>
            <tbody>';
        $currentCaseNumber = $row["caseNumber"];
    }
    ?>
    <tr>
        <td><?php echo $row["id"]; ?></td>
        
        <td><?php echo $row["citation"]; ?></td>
        <td><?php echo $row["activityDate"]; ?></td>
        
        <td>
          <?php echo $row["finalDoc"]; ?>
          <!-- View button for finalDoc -->
          <div class="div1">
            <div class="pdf-container">
                <button class="show-pdf-btn" onclick="openPdfInNewTab('../include/add_filing/pdf/<?php echo $row['finalDoc']; ?>')">View</button>
            </div>
          </div>
        </td>
        <td>
            <!-- decline -->
            <a class='btn btn-danger delete-record' 
               data-record-id='<?php echo $row['id']; ?>' 
               href='../include/add_filing/deleteRecords.php'>delete</a>
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

    <?php include('../partials/side-bot.php'); ?>

  </body>
</html>
