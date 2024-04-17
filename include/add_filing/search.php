<!-- search bar -->
<h1 class="section_header"><i class="fa fa-search"></i>Search for a case to add records:</h1>
<form action="addRecords.php" method="POST">
    <div class="input-group mb-3">
        <!-- Text input field -->
        <input type="text" name="search" placeholder="Search by Case Number" class="form-control" />
        <!-- Select dropdown -->
        <select name="caseNumber" class="form-control">
            <option value="">-- Select a Case Number --</option>
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