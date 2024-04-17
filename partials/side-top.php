<?php
session_start(); // Start the session

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
$userLevel = $user['level'];

function isAdmin($userLevel) {
    return ($userLevel == 'admin');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/nav.css">
    <?php include '../CSS/resources.html'; ?>   

    <style>
        form {
            margin-left: 70px;
            width: 50%;
        }

        #pdf {
            font-size: 15px;
            font-weight: bold;
            margin-top: 10px;
        }

        #upload {
            font-size: 10px;
            font-weight: bold;
        }

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
            top: 0px;
            left: 20px;
            background-color: #3498db;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            width: 60px;
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <i class="bx bxl-codepen"></i>
                <span>CMS</span>
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>

        <div class="user">
            <!-- <img src="../images/user/brian.JPG" alt="me" class="use-img" /> -->
            <div>
                <p><?= $user['firstName']. ' ' . $user['lastName']?></p>
                <p><?= $user['level']?></p>
            </div>
        </div>
        <ul>
            <li>
                <a href="../interface/dashboard.php">
                    <i class="bx bxs-grid-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>

            <?php if (isAdmin($userLevel)): ?>
                <li>
                    <a href="../interface/add-user.php">
                        <i class="bx bxs-user-plus"></i>
                        <span class="nav-item">Users</span>
                    </a>
                    <span class="tooltip">Users</span>
                </li>
            <?php endif; ?>

            <li>
                <a href="../interface/addNewCase.php">
                    <i class="bx bxs-briefcase-alt"></i>
                    <span class="nav-item">Add Cases</span>
                </a>
                <span class="tooltip">Add Cases</span>
            </li>

            <li>
                <a href="../pages/events.php">
                    <i class="bx bxs-calendar-event"></i>
                    <span class="nav-item">Events</span>
                </a>
                <span class="tooltip">Events</span>
            </li>

            <li>
                <a href="../pages/transcripts.php">
                    <i class="bx bxs-file-blank"></i>
                    <span class="nav-item">Transcripts</span>
                </a>
                <span class="tooltip">Transcripts</span>
            </li>
            <li>
                <a href="../interface/evidence.php">
                <i class='bx bx-image'></i>
                    <span class="nav-item">Evidence</span>
                </a>
                <span class="tooltip">Evidence</span>
            </li>
            <li>
                <a href="../pages/reportGen.php">
                    <i class='bx bx-clipboard'></i>
                    <span class="nav-item">Reports</span>
                </a>
                <span class="tooltip">Reports</span>
            </li>

            <!-- <li>
                <a href="../interface/email.php">
                <i class='bx bx-envelope' ></i>
                    <span class="nav-item">Email</span>
                </a>
                <span class="tooltip">Email</span>
            </li> -->

            <!-- <li>
                <a href="../interface/addRecords.php">
                    <i class="bx bxs-file-blank"></i>
                    <span class="nav-item">Add Documentation</span>
                </a>
                <span class="tooltip">Add Documentation</span>
            </li>

            <li>
                <a href="../interface/showFiles.php">
                    <i class="bx bxs-file"></i>
                    <span class="nav-item">View Documentation</span>
                </a>
                <span class="tooltip">Review Documentation</span>
            </li> -->

            <li>
                <a href="../connect/logout.php">
                    <i class="bx bxs-log-out"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="container">
