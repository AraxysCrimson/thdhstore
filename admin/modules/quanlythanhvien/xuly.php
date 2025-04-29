<?php
include('../../config/config.php');

if (isset($_POST['suathanhvien'])) {
    $id = $_GET['iddangky'];
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $role_id = $_POST['role_id'];

    // Kiểm tra xem email hoặc số điện thoại đã tồn tại chưa (trừ ID hiện tại)
    $sql_check = "SELECT * FROM tbl_dangky WHERE (email = '$email' OR dienthoai = '$dienthoai') AND id_dangky != '$id'";
    $result_check = mysqli_query($mysqli, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Nếu email hoặc số điện thoại đã tồn tại, quay lại với thông báo lỗi
        echo "<script>alert('Email hoặc số điện thoại đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
        exit();
    }

    // Nếu không trùng, tiến hành cập nhật
    $sql_update = "UPDATE tbl_dangky SET tenkhachhang = '$tenkhachhang', email = '$email', dienthoai = '$dienthoai', role_id = '$role_id' WHERE id_dangky = '$id'";
    mysqli_query($mysqli, $sql_update);
    
    header('Location: ../../index.php?action=quanlythanhvien&query=lietke');
}

// Xử lý thêm thành viên
if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];
    $matkhau = $_POST['matkhau'];
    $confirm_matkhau = $_POST['confirm_matkhau'];
    $role_id = $_POST['role_id'];

    // Kiểm tra xác nhận mật khẩu
    if ($matkhau !== $confirm_matkhau) {
        echo "<script>alert('Mật khẩu xác nhận không khớp!'); window.history.back();</script>";
        exit();
    }

    // Kiểm tra xem email hoặc số điện thoại đã tồn tại chưa
    $sql_check = "SELECT * FROM tbl_dangky WHERE email = '$email' OR dienthoai = '$dienthoai'";
    $result_check = mysqli_query($mysqli, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>alert('Email hoặc số điện thoại đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
        exit();
    }

    // Nếu hợp lệ, mã hóa mật khẩu và thêm vào database
    $matkhau_hashed = md5($matkhau);
    $sql_dangky = "INSERT INTO tbl_dangky (tenkhachhang, email, dienthoai, diachi, matkhau, role_id, trangthai) 
                   VALUES ('$tenkhachhang', '$email', '$dienthoai', '$diachi', '$matkhau_hashed', '$role_id', 1)";
    mysqli_query($mysqli, $sql_dangky);

    header('Location: ../../index.php?action=quanlythanhvien&query=lietke');
}

// Xử lý xóa thành viên
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_xoa = "DELETE FROM tbl_dangky WHERE id_dangky = '$id'";
    mysqli_query($mysqli, $sql_xoa);
    
    header('Location: ../../index.php?action=quanlythanhvien&query=lietke');
}

// Xử lý chặn/mở khóa thành viên
if (isset($_GET['block'])) {
    $id = $_GET['block'];

    // Lấy trạng thái hiện tại
    $sql_check = "SELECT trangthai FROM tbl_dangky WHERE id_dangky = '$id'";
    $result = mysqli_query($mysqli, $sql_check);
    $row = mysqli_fetch_array($result);

    // Đảo trạng thái (1 = hoạt động, 0 = bị chặn)
    $new_status = ($row['trangthai'] == 1) ? 0 : 1;
    $sql_block = "UPDATE tbl_dangky SET trangthai = '$new_status' WHERE id_dangky = '$id'";
    mysqli_query($mysqli, $sql_block);

    header('Location: ../../index.php?action=quanlythanhvien&query=lietke');
}
?>
