<?php
session_start();
include 'connect.php';
//login
if (isset($_SESSION['status']) == "admin") {
    header("location: index.php");
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password' "; // คำสั่งที่จะให้ทำงาน SQL
    $qr = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($qr);
    if ($num >= 1) {
        $rs = mysqli_fetch_assoc($qr);
        $_SESSION['nameadmin'] = $rs['name'];
        $_SESSION['status'] = "admin"; // ทำการสร้าง Session "admin" เพื่อใช้ในการตรวจสอบการเข้าระบบ
        header("location: index.php"); //เปลี่ยนไปหน้า admin.php
    } else { ?>
        <div class="alert alert-danger my-2" role="alert">
            Login Error
        </div>
<?php
    }
}
?>

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical_Room</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js "></script>
</head>

<body>



    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" autocomplete="off">
                            <div class="form-group">
                                <h3>เข้าสู่ระบบ</h3>
                            </div>

                            <div class="form-group my-2">
                                <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้" required>
                            </div>
                            <div class="form-group my-2">
                                <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary my-2">เข้าสู่ระบบ</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>