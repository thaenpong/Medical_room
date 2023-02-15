<?php
if (empty($_GET['id'])) {
    header("location: admin.php?page=docreport");
} else {
    $id = $_GET['id'];
    $file = $_GET['file'];
    echo $file;
    unlink("files/" . $file);
    $sql = "DELETE FROM doc_report WHERE ID = $id";
    $qr = mysqli_query($conn, $sql);
    if ($qr) {
        echo '<script>alert("ลบข้อมูลเรียบร้อยแล้ว");
        window.location.href="index.php?page=docreport";
        </script>';
    }
}
