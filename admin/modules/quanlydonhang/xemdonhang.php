<?php
$root_path = realpath(dirname(__FILE__) . '/../../config/config.php');
if (file_exists($root_path)) {
    include_once($root_path);
} else {
    die("❌ Không thể tải file cấu hình. Kiểm tra lại đường dẫn: $root_path");
}

// Kiểm tra nếu không có mã đơn hàng
if (!isset($_GET['code'])) {
    die("❌ Không có mã đơn hàng!");
}

$code = mysqli_real_escape_string($mysqli, $_GET['code']);

// Truy vấn thông tin đơn hàng
$sql_donhang = "SELECT * FROM tbl_cart WHERE code_cart = '$code' LIMIT 1";
$query_donhang = mysqli_query($mysqli, $sql_donhang);
$row_donhang = mysqli_fetch_array($query_donhang);
$cart_status = $row_donhang['cart_status'];

// Truy vấn chi tiết đơn hàng
$sql_lietke_dh = "SELECT cd.*, sp.tensanpham, sp.hinhanh, sp.masp, sp.giamgia, sp.gianhap, sz.name
                  FROM tbl_cart_details cd
                  INNER JOIN tbl_sanpham sp ON cd.id_sanpham = sp.id_sanpham
                  INNER JOIN tbl_size sz ON cd.size_id = sz.size_id
                  WHERE cd.code_cart = '$code'
                  ORDER BY cd.id_cart_details DESC";

$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);

// Kiểm tra nếu không có đơn hàng
if (!$query_lietke_dh || mysqli_num_rows($query_lietke_dh) == 0) {
    die("❌ Không tìm thấy đơn hàng với mã: $code");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-receipt"></i> Chi tiết đơn hàng #<?php echo htmlspecialchars($code); ?></h5>
            <a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/thoitrangnam/admin/index.php?action=quanlydonhang&query=lietke'; ?>" 
   class="btn btn-secondary btn-sm">
    <i class="fa fa-arrow-left"></i> Quay lại
</a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Mã SP</th>
                            <th>Size</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th style="color:red;"><i>Giá nhập</i></th>
                            <th style="color:red;"><i>Lợi nhuận</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $tongtien = 0;
                        $tongtiennhap = 0;
                        while ($row = mysqli_fetch_array($query_lietke_dh)) {
                            $i++;
                            $thanhtien = $row['giamgia'] * $row['soluongmua'];
                            $tongtien += $thanhtien;
                            $tiennhap = $row['gianhap'] * $row['soluongmua'];
                            $tongtiennhap += $tiennhap;
                            $loinhuan_sanpham = $thanhtien - $tiennhap;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo htmlspecialchars($row['code_cart']); ?></td>
                                <td><?php echo htmlspecialchars($row['tensanpham']); ?></td>
                                <td>
    <img style="width:150px; height:150px; object-fit:contain; border:1px solid #ddd;" 
         src="/thoitrangnam/admin/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" 
         alt="Hình ảnh <?php echo htmlspecialchars($row['tensanpham']); ?>">
</td>
                                <td><?php echo $row['soluongmua']; ?></td>
                                <td><?php echo htmlspecialchars($row['masp']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo number_format($row['giamgia'], 0, ',', '.'); ?> VNĐ</td>
                                <td><?php echo number_format($thanhtien, 0, ',', '.'); ?> VNĐ</td>
                                <td><?php echo number_format($tiennhap, 0, ',', '.'); ?> VNĐ</td>
                                <td><?php echo number_format($loinhuan_sanpham, 0, ',', '.'); ?> VNĐ</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="11" class="text-right">
                                <p class="mb-2">Tổng tiền: <strong><?php echo number_format($tongtien, 0, ',', '.'); ?> VNĐ</strong></p>
                                <p class="mb-0 text-danger">Tổng lợi nhuận: <strong><?php echo number_format($tongtien - $tongtiennhap, 0, ',', '.'); ?> VNĐ</strong></p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Nút xác nhận đơn hàng -->
            <div class="text-center mt-3">
                <?php if ($cart_status == 1) { ?>
                    <a href="modules/quanlydonhang/xuly.php?action=xacnhan&code=<?php echo $code; ?>" 
                       class="btn btn-success">
                        <i class="fas fa-check"></i> Xác nhận đơn hàng
                    </a>
                <?php } else { ?>
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-check-circle"></i> Đã xác nhận
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
