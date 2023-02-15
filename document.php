<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
require('fpdf/fpdf.php');

//รับค่า Getมาจากหน้า form.php
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


$pdf->SetY('64'); //กำหนด แกน Y (แนวตั้ง)
$pdf->SetX('55'); //กำหนด แกน Y (แนวนอน)
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $std_prefix)); //คำนำหน้า

$pdf->SetX('66');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $std_name)); //ชื่อ
$pdf->SetX('85');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $std_ser)); //นามสกุล

$pdf->SetX('118');
$pdf->Cell(0, 0, '' . $age); //อายุ

$pdf->SetX('178');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $birth)); //วันเกิด

$pdf->SetY('76');
$pdf->SetX('80');
$pdf->Cell(0, 0, '' . $idcard); //บัตรประชาชน

$pdf->SetY('88');
$pdf->SetX('55');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $std_address)); //ที่อยู๋

$pdf->SetY('100');
$pdf->SetX('45');
$pdf->Cell(0, 0, '' . $phone); //เบอร์
$pdf->SetX('120');
$pdf->Cell(0, 0, '' . $email); //อีเมล

$pdf->SetY('112');
$pdf->SetX('45');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', 'วิทยาลัยอาชีวศีกษาลำปาง')); //ชื่อสถานศึกษา

$pdf->SetX('140');
$pdf->Cell(0, 0, '' . $policy); //หมายเลขกรมธรรม์ 

$pdf->SetY('130');
$pdf->SetX('85');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $injury_date)); //วันเกิดการเจ็บป่วยครั้งแรก

$pdf->SetX('168');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $injury_detail)); // ลักษณะอาการบาดเจ็บ

$pdf->SetY('142');
$pdf->SetX('50');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $ac_date)); //วันที่เกิดอุบัติเหตุ

$pdf->SetX('115');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $ac_time)); // เวลาที่เกิด อุบัตืเหตุ

$pdf->SetX('160');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $ac_address)); // สถานที่เกิดเหตุ

$pdf->SetY('160');
$pdf->SetX('40');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $d_date)); //วันที่เสียชีวิต
$pdf->SetX('70');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $d_time)); // เวลาเสียชีวิต
$pdf->SetX('120');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $d_cuase)); // สาเหตุการเสียชีวิต
$pdf->SetX('178');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $d_addresss)); // สถานที่ เสียชีวิต

$pdf->SetY('178');
$pdf->SetX('93');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $de_date)); // วันที่พิการ
$pdf->SetX('173');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $de_detail)); // อาการ

if ($tranfer == 'bank') { // โอนผ่านธนาคาร
    $pdf->Image('fpdf/imgs/check.png', 16, 198, 5, 5);
    $pdf->SetY('200');
    $pdf->SetX('90');
    $pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $tranfer_values)); //เลขบัญชี

} elseif ($tranfer == 'cheque') { // รับเป็นเชค
    $pdf->Image('fpdf/imgs/check.png', 16, 205, 5, 5);
    $pdf->SetY('208');
    $pdf->SetX('55');
    $pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $tranfer_values)); //ที่อยู่การจัดส่ง เชค

}

$pdf->SetY('260');
$pdf->SetX('120');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $re_prefix . ' ' . $name_re . ' ' . $ser_re));
$pdf->SetY('275');
$pdf->SetX('90');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . $relation));
$pdf->SetX('160');
$pdf->Cell(0, 0, iconv('UTF-8', 'cp874', '' . DateThai(date("Y-m-d")))); //กำหนดเว็นเวลาปัจบัน

$pdf->AddPage(); //เพิ่มหนาใหม่ 
$pdf->Image('fpdf/imgs/Form_2.png', 0, 0, 210, 297); //เพิ่มแบบฟอร์มหน้า 2
foreach ($doc as $doc) { // รับตัวแปลการเชคมารัน loop เพื่อเปิด switch
    switch ($doc) {
        case '1':
            $pdf->Image('fpdf/imgs/check.png', 37, 57, 5, 5);
            break;
        case '2':
            $pdf->Image('fpdf/imgs/check.png', 37, 64, 5, 5);
            break;
        case '3':
            $pdf->Image('fpdf/imgs/check.png', 37, 77, 5, 5);
            break;
        case '4':
            $pdf->Image('fpdf/imgs/check.png', 37, 84, 5, 5);
            break;
        case '5':
            $pdf->Image('fpdf/imgs/check.png', 37, 91, 5, 5);
            break;
        case '6':
            $pdf->Image('fpdf/imgs/check.png', 37, 97, 5, 5);
            break;
        case '7':
            $pdf->Image('fpdf/imgs/check.png', 37, 104, 5, 5);
            break;
        case '8':
            $pdf->Image('fpdf/imgs/check.png', 37, 111, 5, 5);
            break;
        case '9':
            $pdf->Image('fpdf/imgs/check.png', 37, 151, 5, 5);
            break;
        case '10':
            $pdf->Image('fpdf/imgs/check.png', 37, 157, 5, 5);
            break;
        case '11':
            $pdf->Image('fpdf/imgs/check.png', 37, 164, 5, 5);
            break;
        case '12':
            $pdf->Image('fpdf/imgs/check.png', 37, 171, 5, 5);
            break;
        case '13':
            $pdf->Image('fpdf/imgs/check.png', 37, 177, 5, 5);
            break;
        case '14':
            $pdf->Image('fpdf/imgs/check.png', 37, 184, 5, 5);
            break;
        case '15':
            $pdf->Image('fpdf/imgs/check.png', 37, 191, 5, 5);
            break;
    }
}
$filename = "files/" . $std_name . date("d-m-y") . date("h-i-sa") . ".pdf"; //บันทึกเอกสาร
$pdf->Output($filename, 'F');
$pdf->Output();
