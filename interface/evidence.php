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
$_SESSION['table'] = 'evidence';
$users = include('../include/add_user/show_users.php');
// $doc = include('../include/add_filing/showAdd.php');
?>


<div class="dashboard_content_main">
    <h1 class="section_header"><i class="fa fa-plus"></i>Add evidence</h1>

    <div class="dashboard_content">
        <!-- start -->
        <!-- view records button -->
        <div>
            <a href="showFiles.php" class="btn btn-primary">preview records</a>
        </div>
        <!-- form -->
        <form action="../include/evidence/evidence.inc.php" method="POST" enctype="multipart/form-data"
            class="appForm" id="userAddForm">
            <div class="appFormInputContainer">
                <label for="caseNumber">Case Number</label>
                <input type="text" class="appFormInput" id="caseNumber" name="caseNumber">
            </div>

            <div class="appFormInputContainer">
                <label for="activityDate">Date</label>
                <input type="date" class="appFormInput" id="date" name="date">
            </div>

            <div class="appFormInputContainer">
                <label for="activityDate">Image</label>
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            
            <div class="appFormInputContainer">
                <label for="" style="text-transformation: capitalize;">Choose PDF</label><br>
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
<h1 class="section_header"><i class="fa fa-search"></i>Search for case number:</h1>
<form action="evidence.php" method="POST">
    <div class="input-group input-group-sm mb-3">
      <!-- Text input field -->
      <input type="text" name="search" placeholder="Search by Case Number" class="form-control" />

      <!-- dropdown list -->
        <select name="caseNumber" class="form-select">
          <option disabled selected>Select case number</option>            
          <?php
            // Read from the database table to populate the select options
            $sql = "SELECT DISTINCT caseNumber FROM evidence ORDER BY caseNumber";
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
$sql = "SELECT * FROM evidence WHERE caseNumber = '$search' ORDER BY caseNumber";
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
        echo '<div class="users"><table class="">

        <thead>
            <th>Date</th>
            <th>Image</th>
            <th>view Image</th>
            <th>Doc</th>
            <th>view Doc</th>
            <th>Action</th>
        </thead>
        <tbody>';
        $currentCaseNumber = $row["caseNumber"];
    }
    ?>
<tr>
    <td><?php echo $row["date"]; ?></td>
    <td><?php echo $row["image"]; ?></td>
    <td>
        <!-- view button for doc -->
    <div class="div1">
            <div class="pdf-container">
                <button class="show-pdf-btn" onclick="openPdfInNewTab('../include/evidence/upload/<?php echo $row['image']; ?>')">View</button>
            </div>
          </div>
    </td>


    <td><?php echo $row["doc"]; ?></td>

    <td>
        <!-- view button for doc -->
    <div class="div1">
            <div class="pdf-container">
                <button class="show-pdf-btn" onclick="openPdfInNewTab('../include/evidence/upload/<?php echo $row['doc']; ?>')">View</button>
            </div>
          </div>
    </td>

    <td>
        <!-- decline -->
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

<?php include('../partials/side-bot.php'); ?>

<script src = "../include/evidence/delete.js"></script>  
</body>
</html>
