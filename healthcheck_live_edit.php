<?php
include_once("connect.php");
$db = mysqli_connect($servername, $username, $password, $dbname);
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {
    $update_field = '';
    if (isset($input['healthcheck_1'])) {
        $update_field .= "healthcheck_1='" . $input['healthcheck_1'] . "'";
    } else if (isset($input['healthcheck_2'])) {
        $update_field .= "healthcheck_2='" . $input['healthcheck_2'] . "'";
    } else if (isset($input['healthcheck_3'])) {
        $update_field .= "healthcheck_3='" . $input['healthcheck_3'] . "'";
    }
    if ($update_field && $input['ID_student']) {
        $sql_query = "UPDATE students SET $update_field WHERE ID_student='" . $input['ID_student'] . "'";
        mysqli_query($db, $sql_query) or die("database error:" . mysqli_error($db));
    }
}
