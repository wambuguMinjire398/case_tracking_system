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
    <h1 class="section_header"><i class="bx bx-plus"></i>Add new event</h1>

    <div class="dashboard_content">
        <!-- start -->
        <!-- view records button -->
        <div>
            <a href="showFiles.php" class="btn btn-primary">preview records</a>
        </div>
        <!-- form -->
        <form action="../include/add_filing/addRecords.inc.php" method="POST" enctype="multipart/form-data"
            class="appForm" id="userAddForm">
            <div class="appFormInputContainer">
                <label for="caseNumber">Case Number</label>
                <input type="text" class="appFormInput" id="caseNumber" name="caseNumber">
            </div>

            <div class="appFormInputContainer">
                <label for="citation">Citation</label>
                <input type="text" class="appFormInput" id="citation" name="citation">
            </div>

            <div class="appFormInputContainer">
                <label for="activityDate">Activity Date</label>
                <input type="date" class="appFormInput" id="activityDate" name="activityDate">
            </div>

            <div class="appFormInputContainer">
                <label for="" style="text-transformation: capitalize;">Choose original transcript</label><br>
                <input id="pdf" class="form-control-file" type="file" name="pdf" value="" /><br>
            </div>

            <!--upload button-->
            <button type="submit" class="appbtn"><i class="fa fa-plus"></i> Add</button>
        </form>

        <?php
        if (isset($_SESSION['response'])) {

            $response_message = $_SESSION['response']['message'];
            $is_success = $_SESSION['response']['success'];
            ?>

        <div class="responseMessage">
            <p class="<?= $is_success ? 'responseMessage_success' : 'responseMessage_error'?>">
                <?= $response_message?>
            </p>
        </div>
        <?php unset($_SESSION['response']); } ?>

    </div>

<!-- serach bar -->
<h1 class="section_header"><i class="fa fa-search"></i>Search for a case to add records:</h1>
<form action="addRecords.php" method="POST">
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

<!-- records table -->
<h1 class="section_header"><i class="fa fa-plus"></i>Case list</h1>

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
        echo '<h2 class="section_header">Case Number: ' . $row["caseNumber"] . ', Citation: ' . $row["citation"] . '</h2>';
        echo '<div class="users"><table class="">

        <thead>
            <th>activityDate</th>
            <th>roughDoc</th>
            <th>view Doc</th>
            <th>Amended Doc</th>
            <th>finalDoc</th>
            <th>Action</th>
        </thead>
        <tbody>';
        $currentCaseNumber = $row["caseNumber"];
    }
    ?>
<tr>
    <td><?php echo $row["activityDate"]; ?></td>
    <td><?php echo $row["roughDoc"]; ?></td>

    <td>
        <!-- view button for rough doc -->
    <div class="div1">
            <div class="pdf-container">
                <button class="show-pdf-btn" onclick="openPdfInNewTab('../include/add_filing/pdf/<?php echo $row['roughDoc']; ?>')">View</button>
            </div>
          </div>
    </td>

    <td>
        <!-- where amendedDoc goes... -->
        <form action="../include/add_filing/updateFinal.php" method="POST" enctype="multipart/form-data">
            <input id="pdf" class="form-control-file" type="file" name="pdf" value="" />
            <input type="hidden" name="record_id" value="<?php echo $row['id']; ?>">
            <button class="btn btn-primary" id="upload" type="submit" name="submit">Upload</button><br>
        </form>
    </td>

    <td><?php echo $row["finalDoc"]; ?></td>
    <td>
        <!-- decline -->
        <a class='btn btn-danger delete-record' data-record-id='<?php echo $row['id']; ?>'
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

<?php include('../partials/side-bot.php'); ?>

</body>
</html>
