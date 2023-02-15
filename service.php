<?php


if (isset($_POST['submit'])) {

    $ID_student = $_POST['ID_student'];
    $std_prefix = $_POST['std_prefix'];
    $std_name = $_POST['std_name'];
    $std_ser = $_POST['std_ser'];
    $lev = $_POST['lev'];
    $branch = $_POST['branch'];
    $symptoms = $_POST['symptoms'];
    $detail = $_POST['detail'];
    $treatment = $_POST['treatment'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $sqlinsert = "INSERT INTO treatment_report (ID_student, std_prefix, std_name, std_ser, lev, branch, symptoms, detail, treatment, date, time)
            VALUES('$ID_student', '$std_prefix', '$std_name', '$std_ser', '$lev', '$branch', '$symptoms', '$detail', '$treatment', '$date', '$time')";
    $qrinsert = mysqli_query($conn, $sqlinsert);
    if ($qrinsert) {
        header("Location: index.php?page=thxservice");
    } else { ?>
        <div class="alert alert-danger my-2" role="alert">
            ไม่สามารถบันทึกข้อมูลได้
        </div>
<?php
    }
}
?>
<div class="row">
    <div class="text-center my-3">
        <h1><b>บันทึกการบริการ</b></h1>
    </div>
    <h4><b>กรุณากรอกข้อมูล</b></h4>
    <form action="" method="post" class="needs-validation" novalidate>
        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">รหัสนักศีกษา</label>
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control" name="ID_student" placeholder="รหัสนักศึกษา" required>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">คำนำหน้า</label>
            <div class="col-md-2">
                <select class="form-select" name="std_prefix" required>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">ชื่อ</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="std_name" placeholder="ชื่อ" required>
            </div>
            <label for="" class="col-md-1 col-form-label">นามสกุล</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="std_ser" placeholder="นามสกุล" required>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">ระดับชั้น</label>
            <div class="col-md-2">
                <select class="form-select" name="lev" required>
                    <option value="ปวช.1">ปวช. 1</option>
                    <option value="ปวช.2">ปวช. 2</option>
                    <option value="ปวช.3">ปวช. 3</option>
                    <option value="ปวส.1">ปวส. 1</option>
                    <option value="ปวส.2">ปวส. 2</option>
                    <option value="ป.ตรี">ป.ตรี</option>
                </select>
            </div>
            <label for="" class="col-md-1 col-form-label">สาขา</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="branch" placeholder="สาขา" required>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="">อาการ</label>
            <div class="col-md-1">
            </div>
            <div class="col-md-11">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="อาการป่วย" name="symptoms" id="radio1" required>
                    <label class="form-check-label col-sm-4" for="radio1">
                        อาการป่วย
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" value="อุบัติเหตุ" name="symptoms" id="radio2" required>
                    <label class="form-check-label" for="radio2">
                        อุบัติเหตุ
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">รายระเอียด</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="detail" placeholder="รายระเอียด" required>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">การรักษา</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="treatment" placeholder="การรักษา" required>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label for="" class="col-md-2 col-form-label">วันที่</label>
            <div class="col-md-3">
                <input type="date" class="form-control" name="date" required>
            </div>
            <label for="" class="col-md-1 col-form-label">เวลา</label>
            <div class="col-md-4">
                <input type="time" class="form-control" name="time" required>
            </div>
        </div>

        <hr>
        <div class="form-group row my-3 justify-content-center">
            <button type="submit" name="submit" class="btn btn-lg col-md-6 col-form-label btn-success">บันทึก</button>
        </div>
        <br>
    </form>
</div>