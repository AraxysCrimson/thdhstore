<?php
include('../../config/config.php');

if (isset($_GET['code'])) {
    $id_feedback = $_GET['code'];

    // Kiểm tra phản hồi có tồn tại không
    $sql_check = "SELECT * FROM feedback WHERE id_feedback = '$id_feedback'";
    $result_check = mysqli_query($mysqli, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        $sql_update = "UPDATE feedback SET status_lh = 0 WHERE id_feedback = '$id_feedback'";
        mysqli_query($mysqli, $sql_update);
    }

    header('Location: ../../index.php?action=quanlyphanhoi&query=lietke');
}
?>
