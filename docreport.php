<?php
if (!isset($_SESSION['medical_login']) && $_SESSION['medical_login'] != "logined") {
    header("location:index.php");
}
$sql = "SELECT * FROM doc_report";
$qr = mysqli_query($conn, $sql);
?>

<div class="text-center my-5">
    <h1><b>รายการเรียกค่าสินไหม</b></h1>
</div>
<div class="table-responsive-md">
    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ชื่อ-นามสกุล</th>
                <th scope="col">ผู้รับสินไหม</th>
                <th scope="col">วันที่</th>
                <th scope="col">ไฟล์</th>
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
                    <td><?= $rs['prefix'] . ' ' . $rs['name'] . ' ' . $rs['ser']; ?></td>
                    <td><?= $rs['re_prefix'] . ' ' . $rs['name_re'] . ' ' . $rs['ser_re']; ?></td>
                    <td><?= $rs['date']; ?></td>
                    <td> <a href="files/<?= $rs['file']; ?>" download>Dowload</a></td>
                    <td>
                        <a href="index.php?page=deldoc&id=<?= $rs['ID']; ?>&file=<?= $rs['file']; ?>" class="btn btn-danger">ลบ </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>