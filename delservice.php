<?php
if (empty($_GET['id'])) {
    header("location: admin.php?page=servicereport");
} else {
    $id = $_GET['id'];
    $sql = "DELETE FROM treatment_report WHERE ID = $id";
    $qr = mysqli_query($conn, $sql);
    if ($qr) {
        echo '<script>alert("ลบข้อมูลเรียบร้อยแล้ว");
        window.location.href="index.php?page=servicereport";
        </script>';
    }
}
