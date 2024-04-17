<?php
include('../connect/connect.php');

// sql stms
$sql = "SELECT * FROM events ORDER BY activityDate DESC";

// execute sql
$result = $conn->query($sql);

// check if success
if ($result) {
    // get the number of rows in result
    $rows=[];
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }
    // free result
    $result->free();

    // return data fetched
    print_r($rows);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
