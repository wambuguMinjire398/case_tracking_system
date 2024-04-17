<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .pdf-container {
            position: relative;
            width: 30px;
            height: 30px;
            padding: 30px;
        }

        .pdf-embed {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .show-pdf-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #3498db;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="div1">
        <?php 
        include 'dbconn.php';

        $sql = "SELECT file FROM test";
        $query = mysqli_query($conn, $sql);

        while ($info = mysqli_fetch_array($query)) {
            ?>
            <div class="pdf-container">
                <button class="show-pdf-btn" onclick="openPdfInNewTab('pdf/<?php echo $info['file']; ?>')">Show PDF</button>
                <embed class="pdf-embed" type="application/pdf" src="pdf/<?php echo $info['file']; ?>" width="300" height="300">
            </div>
        <?php
        }
        ?>
    </div>

    <script>
        function openPdfInNewTab(pdfUrl) {
            window.open(pdfUrl, '_blank');
        }
    </script>
</body>
</html>
