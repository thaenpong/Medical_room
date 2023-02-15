<?php

$sql = "SELECT * FROM edu_set_group";
$qr = mysqli_query($conn, $sql);

if (isset($_POST['submit'])) {
    $id_std = $_POST['ID_student'];
    $first = $_POST['first'];
    $second = $_POST['second'];
    $third = $_POST['third'];

    $sqlinsert = "INSERT INTO std_healthcheck (ID_healthstudent	, first, second, third)
            VALUES('$id_std', '$first', '$second', '$third')";
    $qrinsert = mysqli_query($conn, $sqlinsert);
    if ($qrinsert) {
        //header("location: index.php?page=healthcheck");
    } else { ?>
        <div class="alert alert-danger my-2" role="alert">
            ไม่สามารถบันทึกข้อมูลได้
        </div>
<?php
    }
}

?>

<div class="text-center my-5">
    <h1><b>รายละเอียดการตรวจสุขภาพ</b></h1>
</div>
<form action="" method="post" class="needs-validation" novalidate>
    <div class="form-group row my-3">
        <label for="" class="col-md-1 col-form-label">ระดับชั้น</label>
        <div class="col-md-2">
            <input class="form-control" list="datalistOptions" placeholder="ระดับชั้น" name="group_name">
            <datalist id="datalistOptions">
                <?php
                while ($rs = mysqli_fetch_assoc($qr)) {
                ?>
                    <option value="<?= $rs['group_name']; ?>">

                        </potion>
                    <?php } ?>
            </datalist>
        </div>
        <div class="col-md-5">
            <button type="submit" name="submit_search" class="btn btn-success">ตรวจสอบ</button>
        </div>
    </div>

</form>
<div class="table-responsive-md">
    <table class="table table-striped" id="data_table">
        <thead class=" text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">ชื่อ-นามสกุล</th>
                <th scope="col">ระดับชั้น</th>
                <th scope="col">ตรวจครั้งที่ 1</th>
                <th scope="col">ตรวจครั้งที่ 2</th>
                <th scope="col">ตรวจครั้งที่ 3</th>
                <!-- <th scope="col">จัดการ</th> -->
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            if (isset($_POST['submit_search'])) {
                $group_name = $_POST['group_name'];
                $sql_search = "SELECT * FROM edu_set_group 
                LEFT JOIN students ON edu_set_group.ID_group = students.ID_group 
                WHERE edu_set_group.group_name = '$group_name'";
                $qr_search = mysqli_query($conn, $sql_search);

                $no = 0;
                while ($rs_search = mysqli_fetch_assoc($qr_search)) {
                    $no++;

            ?>
                    <tr id="<?php echo $rs_search['ID_student']; ?>">
                        <td scope="row"><?= $no; ?></td>
                        <td><?= $rs_search['ID_student']; ?></td>
                        <td><?= $rs_search['std_prefix'] . ' ' . $rs_search['std_name'] . ' ' . $rs_search['std_ser']; ?></td>
                        <td><?= $rs_search['std_level']; ?></td>
                        <td><?= $rs_search['healthcheck_1']; ?></td>
                        <td><?= $rs_search['healthcheck_2']; ?></td>
                        <td><?= $rs_search['healthcheck_3']; ?></td>
                        <!-- <td>
                            <button type="submit" name="submit" class="btn btn-lg col-form-label btn-success">บันทึก</button>
                        </td> -->
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="healthcheck_custum.js"></script>