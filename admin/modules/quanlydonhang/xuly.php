<?php
include('../../config/config.php');

if (isset($_GET['action']) && isset($_GET['code'])) {
    $code_cart = $_GET['code'];

    if ($_GET['action'] == 'xacnhan') {
        // Xác nhận đơn hàng
        $sql_update = "UPDATE tbl_cart SET cart_status = 0 WHERE code_cart = '$code_cart'";
        if (mysqli_query($mysqli, $sql_update)) {
            // Cập nhật lại thống kê doanh thu
            header('Location: ../../index.php?action=quanlydonhang&query=lietke&message=Xác nhận đơn hàng thành công');
        } else {
            die("❌ Lỗi khi xác nhận đơn hàng: " . mysqli_error($mysqli));
        }
    } elseif ($_GET['action'] == 'huydon') {
        // Hoàn trả số lượng sản phẩm
        $sql_get_products = "SELECT * FROM tbl_cart_details WHERE code_cart = '$code_cart'";
        $query_products = mysqli_query($mysqli, $sql_get_products);

        while ($row = mysqli_fetch_array($query_products)) {
            $id_sanpham = $row['id_sanpham'];
            $soluongmua = $row['soluongmua'];
            $sql_update_stock = "UPDATE tbl_sanpham SET soluong = soluong + $soluongmua WHERE id_sanpham = '$id_sanpham'";
            mysqli_query($mysqli, $sql_update_stock);
        }

        // Xóa đơn hàng
        $sql_delete_cart_details = "DELETE FROM tbl_cart_details WHERE code_cart = '$code_cart'";
        mysqli_query($mysqli, $sql_delete_cart_details);
        $sql_delete_cart = "DELETE FROM tbl_cart WHERE code_cart = '$code_cart'";
        if (mysqli_query($mysqli, $sql_delete_cart)) {
            header('Location: ../../index.php?action=quanlydonhang&query=lietke&message=Hủy đơn hàng thành công');
        } else {
            die("❌ Lỗi khi hủy đơn hàng: " . mysqli_error($mysqli));
        }
    }
}
?>
