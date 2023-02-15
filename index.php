<?php
session_start();
include 'connect.php';
if ($_SESSION['medical_login'] != 'logined') {
    header("location: login.php");
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "main";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical_Room</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="fonts/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.tabledit.js"></script>

    <!--<link rel="stylesheet" href="css/div.css">-->
</head>
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container">
        <a href="index.php?page=main" class="navbar-brand">หน้าหลัก</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="navbar-item">
                    <a href="index.php?page=service" class="nav-link">บันทึกการบริการ</a>
                </li>
                <li class="navbar-item">
                    <a href="index.php?page=form" class="nav-link">เรียกค่าสินไหมทดแทน</a>
                </li>
                <li class="navbar-item">
                    <a href="index.php?page=servicereport" class="nav-link">รายละเอียดบันทึกการบริการ</a>
                </li>
                <li class="navbar-item">
                    <a href="index.php?page=docreport" class="nav-link">รายการเรียกค่าสินไหม</a>
                </li>
                <li class="navbar-item">
                    <a href="index.php?page=healthcheck" class="nav-link">ตรวจสุขภาพ</a>
                </li>

            </ul>
            <span class="navbar-text">
                <?= $_SESSION["nameadmin"]; ?>
            </span>
            <a href="logout.php" class="nav-item nav-link btn btn-primary text-white mx-2" type="button">ออกจากระบบ</a>

        </div>
    </div>
</nav>

<body>
    <div class="bg-light">
        <div class="container bg-white ">
            <div class="min-vh-100 ">
                <?php
                include $page . ".php";
                ?>
            </div>
        </div>
    </div>
    <script src="js/required.js"></script>

</body>
<footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Copyright:
        <a class="text-dark" href="#">IT63.1</a>
    </div>
    <!-- Copyright -->
</footer>

</html>