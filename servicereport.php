<?php
if (!isset($_SESSION['medical_login']) && $_SESSION['medical_login'] != "logined") {
    header("location:index.php");
}
$sql = "SELECT * FROM treatment_report";
$qr = mysqli_query($conn, $sql);
?>

<div class="text-center my-5">
    <h1><b>รายละเอียดบันทึกการบริการ</b></h1>
</div>
<div class="table-responsive-md">
    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">ชื่อ-นามสกุล</th>
                <th scope="col">ระดับชั้น</th>
                <th scope="col">อาการ</th>
                <th scope="col">การรักษา</th>
                <th scope="col">วันที่</th>
                <th scope="col">จัดการ</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            $no = 0;
            while ($rs = mysqli_fetch_assoc($qr)) {
                $no++;
            ?>
                <tr>
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $rs['ID_student']; ?></td>
                    <td><?= $rs['std_prefix'] . ' ' . $rs['std_name'] . ' ' . $rs['std_ser']; ?></td>
                    <td><?= $rs['lev']; ?></td>
                    <td><?= $rs['detail']; ?></td>
                    <td><?= $rs['treatment']; ?></td>
                    <td><?= $rs['date']; ?></td>
                    <td>
                        <a href="index.php?page=delservice&id=<?= $rs['ID']; ?>" class="btn btn-danger">ลบ </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>