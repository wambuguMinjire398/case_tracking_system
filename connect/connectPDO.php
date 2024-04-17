<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    // connect to db

    try{
        $conn = new PDO("mysql:host=$servername;dbname=CMS1", $username, $password);
        // set the PDO error mode to exception

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Connected Successfully';
    } catch (\Exception $e){
        // Handle exception, you may want to echo or log the exception message
         $error_message = $e->getMessage();
    }
?>
