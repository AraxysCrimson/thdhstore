<?php
ob_start(); // Để tránh lỗi header()
session_start(); // Đảm bảo session hoạt động
include('../../config/config.php');

if (!$mysqli) {
    die("❌ Lỗi kết nối CSDL: " . mysqli_connect_error());
}

// 🟢 Xử lý thêm danh mục
if (isset($_POST['themdanhmuc'])) {
    $tendanhmuc = mysqli_real_escape_string($mysqli, $_POST['tendanhmuc']);
    $thutu = (int)$_POST['thutu'];

    if (empty($tendanhmuc) || empty($thutu)) {
        $_SESSION['message'] = "⚠️ Vui lòng nhập đầy đủ thông tin!";
        $_SESSION['message_type'] = "warning";
    } else {
        $sql_them = "INSERT INTO tbl_danhmuc (tendanhmuc, thutu) VALUES ('$tendanhmuc', '$thutu')";
        if (mysqli_query($mysqli, $sql_them)) {
            $_SESSION['message'] = "✅ Thêm danh mục thành công!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "❌ Lỗi MySQL: " . mysqli_error($mysqli);
            $_SESSION['message_type'] = "danger";
        }
    }

    mysqli_close($mysqli);
    header("Location: ../../index.php?action=quanlydanhmucsanpham&query=lietke");
    exit();
}

// 🟠 Xử lý sửa danh mục
if (isset($_POST['suadanhmuc']) && isset($_GET['iddanhmuc'])) {
    $id_danhmuc = (int)$_GET['iddanhmuc'];
    $tendanhmuc = mysqli_real_escape_string($mysqli, $_POST['tendanhmuc']);
    $thutu = (int)$_POST['thutu'];

    if (empty($tendanhmuc) || empty($thutu)) {
        $_SESSION['message'] = "⚠️ Không được để trống thông tin!";
        $_SESSION['message_type'] = "warning";
    } else {
        $sql_update = "UPDATE tbl_danhmuc SET tendanhmuc='$tendanhmuc', thutu='$thutu' WHERE id_danhmuc='$id_danhmuc'";
        if (mysqli_query($mysqli, $sql_update)) {
            $_SESSION['message'] = "✅ Cập nhật danh mục thành công!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "❌ Lỗi MySQL: " . mysqli_error($mysqli);
            $_SESSION['message_type'] = "danger";
        }
    }

    mysqli_close($mysqli);
    header("Location: ../../index.php?action=quanlydanhmucsanpham&query=lietke");
    exit();
}

// 🔴 Xử lý xóa danh mục
if (isset($_GET['iddanhmuc'])) {
    $id_danhmuc = (int)$_GET['iddanhmuc'];

    $sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc='$id_danhmuc'";
    if (mysqli_query($mysqli, $sql_xoa)) {
        $_SESSION['message'] = "✅ Xóa danh mục thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "❌ Lỗi MySQL: " . mysqli_error($mysqli);
        $_SESSION['message_type'] = "danger";
    }

    mysqli_close($mysqli);
    header("Location: ../../index.php?action=quanlydanhmucsanpham&query=lietke");
    exit();
}

// Nếu không có hành động nào được thực hiện, quay lại trang chính
mysqli_close($mysqli);
header("Location: ../../index.php?action=quanlydanhmucsanpham&query=lietke");
exit();
?>
