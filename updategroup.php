<?php
include "connect.php";
$sql = "UPDATE students SET std_level='ปวส' WHERE ID_group='643090101'";
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