<?php
session_start(); // Đảm bảo session hoạt động
include('../../config/config.php');

if (!$mysqli) {
    die("❌ Kết nối CSDL thất bại: " . mysqli_connect_error());
}

// 🟢 **THÊM SẢN PHẨM**
if (isset($_POST['themsanpham'])) {
    $tensanpham = mysqli_real_escape_string($mysqli, $_POST['tensanpham']);
    $masp = mysqli_real_escape_string($mysqli, $_POST['masp']);
    $gianhap = mysqli_real_escape_string($mysqli, $_POST['gianhap']);
    $giasp = mysqli_real_escape_string($mysqli, $_POST['giasp']);
    $giamgia = mysqli_real_escape_string($mysqli, $_POST['giamgia']);
    $soluong = mysqli_real_escape_string($mysqli, $_POST['soluong']);
    $size = mysqli_real_escape_string($mysqli, $_POST['size']);
    $danhmuc = mysqli_real_escape_string($mysqli, $_POST['danhmuc']);
    $noidung = mysqli_real_escape_string($mysqli, $_POST['noidung']); // Mô tả sản phẩm

    // 🖼 **Xử lý hình ảnh**
    if (!empty($_FILES['hinhanh']['name'])) {
        $hinhanh = time() . '_' . basename($_FILES['hinhanh']['name']);
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    } else {
        $hinhanh = ''; // Không có ảnh
    }

    $sql_them = "INSERT INTO tbl_sanpham (tensanpham, masp, gianhap, giasp, giamgia, soluong, size, hinhanh, id_danhmuc, noidung) 
                 VALUES ('$tensanpham', '$masp', '$gianhap', '$giasp', '$giamgia', '$soluong', '$size', '$hinhanh', '$danhmuc', '$noidung')";

    if (mysqli_query($mysqli, $sql_them)) {
        $_SESSION['message'] = "✅ Thêm sản phẩm thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "❌ Lỗi khi thêm sản phẩm: " . mysqli_error($mysqli);
        $_SESSION['message_type'] = "danger";
    }

    header('Location: ../../index.php?action=quanlysp&query=lietke');
    exit();
}

// 🟠 **SỬA SẢN PHẨM**
if (isset($_POST['suasanpham']) && isset($_GET['idsanpham'])) {
    $id_sanpham = mysqli_real_escape_string($mysqli, $_GET['idsanpham']);
    $tensanpham = mysqli_real_escape_string($mysqli, $_POST['tensanpham']);
    $masp = mysqli_real_escape_string($mysqli, $_POST['masp']);
    $giasp = mysqli_real_escape_string($mysqli, $_POST['giasp']);
    $giamgia = mysqli_real_escape_string($mysqli, $_POST['giamgia']);
    $gianhap = mysqli_real_escape_string($mysqli, $_POST['gianhap']);
    $soluong = mysqli_real_escape_string($mysqli, $_POST['soluong']);
    $size = mysqli_real_escape_string($mysqli, $_POST['size']);
    $danhmuc = mysqli_real_escape_string($mysqli, $_POST['danhmuc']);
    $noidung = mysqli_real_escape_string($mysqli, $_POST['noidung']); // Mô tả sản phẩm

    // 🖼 **Kiểm tra xem có tải ảnh mới không**
    if (!empty($_FILES['hinhanh']['name'])) {
        $hinhanh = time() . '_' . basename($_FILES['hinhanh']['name']);
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);

        // 📸 **Lấy ảnh cũ và xóa nếu có**
        $sql_get_old = "SELECT hinhanh FROM tbl_sanpham WHERE id_sanpham='$id_sanpham' LIMIT 1";
        $result_old = mysqli_query($mysqli, $sql_get_old);
        $row_old = mysqli_fetch_assoc($result_old);
        if (!empty($row_old['hinhanh']) && file_exists('uploads/' . $row_old['hinhanh'])) {
            unlink('uploads/' . $row_old['hinhanh']);
        }

        $sql_update = "UPDATE tbl_sanpham SET tensanpham='$tensanpham', masp='$masp', giasp='$giasp', giamgia='$giamgia', gianhap='$gianhap', 
                       soluong='$soluong', size='$size', hinhanh='$hinhanh', id_danhmuc='$danhmuc', noidung='$noidung' WHERE id_sanpham='$id_sanpham'";
    } else {
        // 📌 **Không có ảnh mới**
        $sql_update = "UPDATE tbl_sanpham SET tensanpham='$tensanpham', masp='$masp', giasp='$giasp', giamgia='$giamgia', gianhap='$gianhap', 
                       soluong='$soluong', size='$size', id_danhmuc='$danhmuc', noidung='$noidung' WHERE id_sanpham='$id_sanpham'";
    }

    if (mysqli_query($mysqli, $sql_update)) {
        $_SESSION['message'] = "✅ Cập nhật sản phẩm thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "❌ Lỗi khi cập nhật sản phẩm: " . mysqli_error($mysqli);
        $_SESSION['message_type'] = "danger";
    }

    header('Location: ../../index.php?action=quanlysp&query=lietke');
    exit();
}

// 🔴 **XÓA SẢN PHẨM**
if (isset($_GET['idsanpham'])) {
    $id_sanpham = mysqli_real_escape_string($mysqli, $_GET['idsanpham']);

    // 📸 **Lấy thông tin sản phẩm cần xóa**
    $sql_get = "SELECT hinhanh FROM tbl_sanpham WHERE id_sanpham='$id_sanpham' LIMIT 1";
    $query_get = mysqli_query($mysqli, $sql_get);
    $row = mysqli_fetch_assoc($query_get);

    // 🚮 **Xóa ảnh nếu có**
    if (!empty($row['hinhanh']) && file_exists('uploads/' . $row['hinhanh'])) {
        unlink('uploads/' . $row['hinhanh']);
    }

    // 🗑 **Xóa sản phẩm khỏi database**
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='$id_sanpham'";
    if (mysqli_query($mysqli, $sql_xoa)) {
        $_SESSION['message'] = "✅ Xóa sản phẩm thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "❌ Lỗi khi xóa sản phẩm: " . mysqli_error($mysqli);
        $_SESSION['message_type'] = "danger";
    }

    header('Location: ../../index.php?action=quanlysp&query=lietke');
    exit();
}
?>
