<?php
include "connect.php";
$sql = "DELETE FROM `students` WHERE std_startyear='2022'";
$qr = mysqli_query($conn, $sql);
if ($qr) {
    header("location: index.php");
} else { ?>
    <div class="alert alert-danger my-2" role="alert">
        ไม่สามารถบันทึกข้อมูลได้
    </div>
<?php
}
?>