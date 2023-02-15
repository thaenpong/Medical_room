<?php
require('fpdf/fpdf.php');

$idcard = $_GET['idcard'];
$std_prefix = $_GET['std_prefix'];
$std_name = $_GET['std_name'];
$std_ser = $_GET['std_ser'];
$birth = $_GET['birth'];
$age = $_GET['age'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$std_address = $_GET['std_address'];
$policy = $_GET['policy'];
$injury_date = $_GET['injury_date'];
$injury_detail = $_GET['injury_detail'];
$ac_date = $_GET['ac_date'];
$ac_time = $_GET['ac_time'];
$ac_address = $_GET['ac_address'];
$d_date = $_GET['d_date'];
$d_time = $_GET['d_time'];
$d_cuase = $_GET['d_cause'];
$d_addresss = $_GET['d_address'];
$de_date = $_GET['de_date'];
$de_detail = $_GET['de_detail'];
$tranfer = $_GET['tranfer'];
$tranfer_values = $_GET['tranfer_values'];
$re_prefix = $_GET['re_prefix'];
$name_re = $_GET['name_re'];
$ser_re = $_GET['ser_re'];
$relation = $_GET['relation'];

$doc = explode(',', $_GET["doc"]); // รับค่ามาเก็บเป็น array





function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
//แปลงวันที่จาก yyyy/mm/dd เป็น dd/mm/yyy
if ($birth != null) {
    $birth = DateThai($birth);
}
if ($injury_date != null) {
    $injury_date = DateThai($injury_date);
}
if ($ac_date != null) {
    $ac_date = DateThai($ac_date);
}
if ($d_date != null) {
    $d_date = DateThai($d_date);
}
if ($de_date != null) {
    $de_date = DateThai($de_date);
}

$pdf = new FPDF('P', 'mm', 'A4'); //กำหนดขนาดเอกสาร หน้า 1
$pdf->AddPage(); // เพิ่มหน้า เอกสาร
$pdf->AddFont('THSarabunNew Bold', '', 'THSarabunNew Bold.php');
$pdf->SetFont('THSarabunNew Bold', '', 14);                     //กำหนด font

$pdf->Image('fpdf/imgs/Form_1.png', 0, 0, 210, 297); //เพิ่มรูปภาพแบบฟอร์ม

$pdf->Output();
