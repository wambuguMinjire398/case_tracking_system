<?php
include '../connect/conn.php';

if (isset($_POST['submit'])) {
    $record_id = $_POST['record_id'];
    $pdf = $_FILES['pdf']['name'];
    $pdf_tem_loc = $_FILES['pdf']['tmp_name'];
    $pdf_store = "pdf/" . $pdf;

    move_uploaded_file($pdf_tem_loc, $pdf_store);

    // Update the record in the database
    $sql = "UPDATE adddoc SET finalDoc = '$pdf' WHERE id = $record_id";
    $query = mysqli_query($conn, $sql);

    header("Location: ../move_record.php");
} else {
    echo "Form not submitted";
}
?>
