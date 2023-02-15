<?php

$check = false; // ตัวแปลตรวจสอบ รหัสนักศึกษา

if (isset($_POST['submit'])) {

    // เชครูปแบบการรับเงิน
    if ($_POST['tranfer'] == 'bank') {
        $tranfer_values = $_POST['id_bank'];
    } elseif ($_POST['tranfer'] == 'cheque') {
        $tranfer_values = $_POST['cheque_address'];
    }

    //รับข้อมูลจาก checkbox มาเปลี่ยนเป็น string 
    $doc = NULL;
    foreach ($_POST['doc'] as $_POST['doc']) {
        if ($doc == NULL) {
            $doc .= $_POST['doc'];
        } else {
            $doc .= "," . $_POST['doc'];
        }
    }
    $prefix = $_POST['std_prefix'];
    $name = $_POST['std_name'];
    $ser = $_POST['std_ser'];
    $date = $_POST['std_name'];
    $re_prefix = $_POST['re_prefix'];
    $name_re = $_POST['name_re'];
    $ser_re = $_POST['ser_re'];
    $filename = $name . date("d-m-y") . date("h-i-sa") . ".pdf";
    $sqlinsert = "INSERT INTO doc_report (prefix, name, ser, re_prefix, name_re, ser_re, date, file)
            VALUES('$prefix','$name', '$ser', '$re_prefix', '$name_re', '$ser_re',NOW(), '$filename')";
    $qrinsert = mysqli_query(
        $conn,
        $sqlinsert
    );


    //รับข้อมูล Post มาไว้ในใตัวแปล และแปลงเป็นลิ้ง Get
    // นักศึกษา
    $std_data = "idcard=" . $_POST['idcard'] . "&std_prefix=" . $_POST['std_prefix'] . "&std_name=" . $_POST['std_name'] . "&std_ser=" . $_POST['std_ser']
        . "&birth=" . $_POST['birth'] . "&age=" . $_POST['age'] . "&phone=" . $_POST['phone'] . "&email=" . $_POST['email'] . "&std_address=" . $_POST['std_address']
        . "&policy=" . $_POST['policy']
        // อุบัติเหต
        . "&ac_date=" . $_POST['ac_date'] . "&ac_time=" . $_POST['ac_time']
        . "&ac_address=" . $_POST['ac_address']
        //กรณีทุพพลภาพ
        . "&injury_date=" . $_POST['injury_date'] . "&injury_detail=" . $_POST['injury_detail']
        //เสียชีวิต
        . "&d_date=" . $_POST['d_date'] . "&d_time=" . $_POST['d_time'] . "&d_cause=" . $_POST['d_cause'] . "&d_address=" . $_POST['d_address'] . "&de_date=" . $_POST['de_date'] . "&de_detail=" . $_POST['de_detail']
        //รับค่าสินไหม
        . "&tranfer=" . $_POST['tranfer'] . "&tranfer_values=" . $tranfer_values
        //ผู้รับสินไหม
        . "&re_prefix=" . $_POST['re_prefix'] . "&name_re=" . $_POST['name_re'] . "&ser_re=" . $_POST['ser_re'] . "&relation=" . $_POST['relation']
        . "&doc=" . $doc;
    //ส่งข้อมูลไปยัง หน้า document.php ในรูปแบบ GET
    echo "<script type=\"text/javascript\">
        window.open('document.php?" . $std_data . "', '_blank')
    </script>";
}
//เชคข้อมูลรหัสนักศึกษา หากมีข้อมูลจะทำการดึงข้อมูบมาไว้้ในแบบฟอร์ม
if (isset($_POST['submit_check'])) {
    $ID_student = $_POST['ID_student'];
    $sql = "SELECT * FROM students WHERE ID_student = '$ID_student'"; // คำสั่งที่จะให้ทำงาน SQL
    $qr = mysqli_query($conn, $sql);
    $rs = mysqli_fetch_assoc($qr);
    if ($rs == null) {
        $check = false; //มีข้อมูล
    } else {
        $check = true; //มีข้อมูล
    }
}
?>
<div class="row">
    <div class="text-center my-3">
        <h1><b>แบบฟอร์มการเรียกค่าสินไหมทดแทน สำหรับนักเรียน/นักศึกษา(Student)</b></h1>
    </div>

    <h4><b>ส่วนที่ 1 รายระเอียดผู้เอาประกันภัย</b></h4>

    <form action="" method="post" id="form_check" class="needs-validation" novalidate>
        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">รหัสนักศีกษา</label>
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control" name="ID_student" placeholder="หากไม่ทราบให้เว้นว่าง" value="<?php
                                                                                                                        if ($check == true) {
                                                                                                                            echo $rs['ID_student'];
                                                                                                                        } else {
                                                                                                                            echo "63309010005";
                                                                                                                        } ?>" required>
            </div>
            <div class="col-md-5">
                <button type="submit" name="submit_check" class="btn <?php
                                                                        if ($check == true) { ?>
                                                                                                    btn-success
                                                                                                <?php } else { ?> btn-secondary <?php } ?>">ตรวจสอบ</button>
            </div>
        </div>
    </form>
    <form action="" method="post" id="form_main" class="needs-validation" novalidate>
        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">รหัสบัตรประจำตัว</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="idcard" placeholder="รหัสบัตรประจำตัว" value="<?php
                                                                                                            if ($check == true) {
                                                                                                                echo $rs['idcard'];
                                                                                                            } ?>" required>
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">คำนำหน้า</label>
            <div class="col-md-2">
                <select class="form-select" name="std_prefix" required>
                    <option value="<?php
                                    if ($check == true) {
                                        echo $rs['std_prefix'];
                                    } ?>"><?php
                                            if ($check == true) {
                                                echo $rs['std_prefix'];
                                            } ?></option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">ชื่อ</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="std_name" placeholder="ชื่อ" value="<?php
                                                                                                    if ($check == true) {
                                                                                                        echo $rs['std_name'];
                                                                                                    } ?>" required>
            </div>
            <label for="" class="col-md-1 col-form-label">นามสกุล</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="std_ser" placeholder="นามสกุล" value="<?php
                                                                                                    if ($check == true) {
                                                                                                        echo $rs['std_ser'];
                                                                                                    } ?>" required>
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">วันเกิด</label>
            <div class="col-md-4">
                <input type="date" class="form-control" name="birth" value="<?php
                                                                            if ($check == true) {
                                                                                echo $rs['std_birthday'];
                                                                            } ?>" required>
            </div>
            <?php
            $dbirth = substr($rs['std_birthday'], 0, 4);
            $dnow = date("Y");
            $dold = (int) $dnow - (int) $dbirth;
            echo $dold;
            ?>
            <label for="" class="col-md-1 col-form-label">อายุ</label>
            <div class="col-md-2">
                <input type="number" class="form-control col-sm-4" name="age" placeholder="อายุ" min="1" max="99" required value="<?php
                                                                                                                                    $dbirth = substr($rs['std_birthday'], 0, 4);
                                                                                                                                    $dnow = date("Y");
                                                                                                                                    $dold = (int) $dnow - (int) $dbirth;
                                                                                                                                    echo $dold;
                                                                                                                                    ?>">
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">เบอร์โทร</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="phone" placeholder="เบอร์โทร" value="<?php
                                                                                                    if ($check == true) {
                                                                                                        echo $rs['std_tel'];
                                                                                                    } ?>" required>
            </div>
            <label for="" class="col-md-1 col-form-label">อีเมล</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="email" placeholder="อีเมล" required value="<?php
                                                                                                            if ($check == true) {
                                                                                                                echo $rs['std_email'];
                                                                                                            } ?>">
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">ที่อยู่</label>
            <div class="col-md-5">
                <textarea class="form-control" name="std_address" rows="3" placeholder="ที่อยู่" required><?php
                                                                                                            if ($check == true) {
                                                                                                                echo $rs['std_address'];
                                                                                                            } ?></textarea>
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">หมายเลขกรมธรรม์</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="policy" placeholder="หมายเลขกรมธรรม์" value="<?php
                                                                                                            if ($check == true) {
                                                                                                                echo $rs['std_policy'];
                                                                                                            } ?>" required>

            </div>
        </div>
        <hr class="my-4">
        <h4> <b>ส่วนที่ 2 รายระเอียดการบาดเจ็บหรือเจ็บป่วย</b> </h4>
        <div class="form-group row my-3">
            <label for="" class="col-md-3 col-form-label">วันที่เกิดอาการบาดเจ็บหรือเจ็บป่วยครั้งแรก</label>
            <div class="col-md-4">
                <input type="date" class="form-control" name="injury_date" required>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-3 col-form-label">ลักษณะอาการที่เจ็บป่วยหรือบาดเจ็บ</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="injury_detail" placeholder="ลักษณะอาการที่เจ็บป่วยหรือบาดเจ็บ" required>
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="" class="col-md-2 col-form-label">วันที่เกิดอุบัติเหตุ</label>
            <div class="col-md-3">
                <input type="date" class="form-control" name="ac_date" required>
            </div>
            <label for="" class="col-md-1 col-form-label">เวลา</label>
            <div class="col-md-4">
                <input type="time" class="form-control" name="ac_time" required>
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">สถานที่เกิดเหตุ</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="ac_address" placeholder="สภานที่เกิดเหตู" required>
            </div>
        </div>
        <h5><u>กรณีเสียชีวิตจากอุบัติเหตุ โปรดระบุรายละเอียด</u></h5>

        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">วันที่เสียชีวิต</label>
            <div class="col-md-3">
                <input type="date" class="form-control" name="d_date">
            </div>
            <label for="" class="col-md-2 col-form-label">เวลาที่เสียชีวิต</label>
            <div class="col-md-4">
                <input type="time" class="form-control" name="d_time">
            </div>
        </div>

        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">สาเหตุการเสียชีวิต</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="d_cause" placeholder="สาเหตุการเสียชีวิต">
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-2 col-form-label">สถานที่เสียชีวิต</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="d_address" placeholder="สถานที่เสียชีวิต">
            </div>
        </div>
        <br>
        <h5><u>กรณีทุพพลภาพถาวรสิ้นเชิง/สูญเสียอวัยวะ/สูญเสียการมองเห็น จากอุบัติเหตุ</u></h5>
        <br>
        <div class="form-group row my-3">
            <label for="" class="col-md-5 col-form-label">วันที่ทุพพลภาพถาวรสิ้นเชิง/สูญเสียอวัยวะ/สูญเสียการมองเห็น</label>
            <div class="col-md-4">
                <input type="date" class="form-control" name="de_date">
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-4 col-form-label">ความสามารถในการทำกิจวัตรประจำวัน</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="de_detail" placeholder="ความสามารถในการทำกิจวัตรประจำวัน">
            </div>
        </div>
        <h4> <b>ขอรับค่าสินไหมทดแทนโดย</b> </h4>
        <div class="form-group row my-3">
            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="bank" name="tranfer" id="radio1" required>
                    <label class="form-check-label col-sm-4" for="radio1">
                        โอนเงินเข้าบัญชี
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="id_bank" placeholder="เลขบัญชีธนาคาร">
                    </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" value="cheque" name="tranfer" id="radio2" required>
                    <label class="form-check-label" for="radio2">
                        เช็ค
                    </label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="cheque_address" rows="3" placeholder="สถานที่จัดส่ง"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <h4> <b>ผู้รับประกัน</b> </h4>
        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">คำนำหน้า</label>
            <div class="col-md-2">
                <select class="form-select" name="re_prefix" required>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">ชื่อ</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="name_re" placeholder="ชื่อผู้รับประกัน" required>
            </div>
            <label for="" class="col-md-1 col-form-label">นามสกุล</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="ser_re" placeholder="นามสกุลผู้รับประกัน" required>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="" class="col-md-1 col-form-label">ความสัมพันธ์</label>
            <div class="col-md-2">
                <input type="text" class="form-control" name="relation" placeholder="ความสัมพันธ์" required>
            </div>
        </div>
        <hr>
        <div class="text-center my-5">
            <h3><b>รายการเอกสารประกอบการเรียกร้องค่าสินไหมทดแทน
                    กรณีผลประโยชน์การรักษาพยาบาล และผลประโยชน์การชดเชยรายได้ระหว่างรักษาตัว
                    ในโรงพยาบาล</b></h3>
        </div>
        <div class="my-4">
            <h4> <b>ผลประโยชน์การรักษาพยาบาล</b> </h4>
            <h4>การประกันภัยอุบัติเหตุส่วนบุคคล หรือการประกันภัยอุบัติเหตุแบบกลุ่ม</h4>
        </div>

        <div class="form-group row my-3">
            <div class="col-md-1"></div>
            <div class="col-md-11">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="1" id="check1">
                    <label class="form-check-label" for="check1">
                        1.แบบแจ้งเรียกร้องค่าสินไหมทดแทน (Claim Form)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="2" id="check2">
                    <label class="form-check-label" for="check2">
                        2. ใบรับรองแพทย์ที่ระบุสาเหตุการบาดเจ็บ และรายละเอียดการรักษา
                        กรณีรักษาตัวเป็นผู้ป่วยใน แนบสำเนาประวัติการรักษา

                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="3" id="check3">
                    <label class="form-check-label" for="check3">
                        3. ใบเสร็จรับเงิน ต้นฉบับ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="4" id="check4">
                    <label class="form-check-label" for="check4">
                        4. สำเนาบัตรประชาชนผู้บาดเจ็บ, สำเนาบัตรประกันภัย หรือบัตรที่ทางราชการออกให้(ลงลายมือชื่อรับรอง)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="5" id="check5">
                    <label class="form-check-label" for="check5">
                        5. สำเนาสมุดบัญชีธนาคารที่ประสงค์ให้โอนเงินค่าสินไหมทดแทน (ต้องเป็นบัญชีของผู้เอาประกันภัยเท่านั้น)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="6" id="check6">
                    <label class="form-check-label" for="check6">
                        6. กรณีประกันภัยอุบัติเหตุกลุ่ม หรือ Payroll แนบหนังสือรับรองการทำงาน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="7" id="check7">
                    <label class="form-check-label" for="check7">
                        7. กรณี PA-นักเรียน แนบสำเนาบัตรนักเรียน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="8" id="check8">
                    <label class="form-check-label" for="check8">
                        8. เอกสารอื่นๆ ที่บริษัทฯ เรียกร้องเพิ่มเติมตามความจา เป็น (ถ้ามี)
                    </label>
                </div>
                <p><u><b>หมายเหตุ</b></u> กรณีผู้เยาว์ประสงค์โอนเงินค่าสินไหมเข้าบัญชีบิดา/มารดาให้แนบสำเนาสูติบัตร</p>
            </div>
        </div>
        <h4 class="my-4">ผลประโยชน์ชดเชยรายได้ระหว่างรักษาตัวในโรงพยาบาล</h4>

        <div class="form-group row my-3">
            <div class="col-md-1"></div>
            <div class="col-md-11">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="9" id="check9">
                    <label class="form-check-label" for="check9">
                        1.แบบแจ้งเรียกร้องค่าสินไหมทดแทน (Claim Form)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="10" id="check10">
                    <label class="form-check-label" for="check10">
                        2. ใบรับรองแพทย์ที่ระบุ สาเหตุการบาดเจ็บ และรายละเอียดการรักษา
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="11" id="check11">
                    <label class="form-check-label" for="check11">
                        3. สำเนาแฟ้มประวัติการรักษาจากสถานพยาบาล
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="12" id="check12">
                    <label class="form-check-label" for="check12">
                        4. สำเนาใบเสร็จรับเงินที่แสดงรายการค่าใช้จ่าย(ถ้ามี)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="13" id="check13">
                    <label class="form-check-label" for="check13">
                        5. สำเนาบัตรประชาชนผู้บาดเจ็บ, สำเนาบัตรประกันภัยหรือบัตรที่ทางราชการออกให้(ลงลายมือชื่อรับรอง)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="14" id="check14">
                    <label class="form-check-label" for="check14">
                        6. สำเนาสมุดบัญชีธนาคารที่ประสงคืให้โอนเงินค่าสินไหมทดแทน (ต้องเป็นบัญชีของผู้เอาประกันภัยเท่านั้น)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doc[]" value="15" id="check15">
                    <label class="form-check-label" for="check15">
                        7. เอกสารอื่นๆ ที่บริษัทฯ เรียกร้องเพิ่มเติมตามความจำเป็น (ถา้มี)
                    </label>
                </div>
                <p><u><b>หมายเหตุ</b></u> กรณีผู้เยาว์ประสงค์โอนเงินค่าสินไหมเข้าบัญชีบิดา/มารดาให้แนบสำเนาสูติบัตร</p>
            </div>
        </div>

        <div class="form-group row my-3">
            <div class="col-md-4 my-4">
            </div>
            <button type="submit" name="submit" class="btn btn-lg col-sm-4 col-form-label btn-success">ตกลง</button>
        </div>
    </form>
</div>