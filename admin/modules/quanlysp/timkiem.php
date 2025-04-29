<?php
// Kết nối database
$root_path = realpath(dirname(__FILE__) . '/../../config/config.php');
if (file_exists($root_path)) {
    include_once($root_path);
} else {
    die("❌ Không thể tải file cấu hình. Kiểm tra lại đường dẫn: $root_path");
}

// Kiểm tra nếu có từ khóa tìm kiếm
if (isset($_POST['timkiem'])) {
    $tukhoa = mysqli_real_escape_string($mysqli, $_POST['tukhoa']);
} else {
    die("❌ Không có từ khóa tìm kiếm!");
}

// Truy vấn danh sách sản phẩm theo từ khóa
$sql_timkiem = "SELECT * FROM tbl_sanpham 
                INNER JOIN tbl_danhmuc ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                WHERE tbl_sanpham.tensanpham LIKE '%$tukhoa%' 
                ORDER BY id_sanpham DESC";

$query_timkiem = mysqli_query($mysqli, $sql_timkiem);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4"><i class="fas fa-search"></i> Kết quả tìm kiếm: "<?php echo htmlspecialchars($tukhoa); ?>"</h2>

    <a href="index.php?action=quanlysp&query=lietke" class="btn btn-secondary mb-3">
        <i class="fa fa-arrow-left"></i> Quay lại danh sách
    </a>

    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Giá bán</th>
                <th>Giảm giá</th>
                <th style="color:red;">Giá nhập</th>
                <th>Số lượng</th>
                <th>Size</th>
                <th>Danh mục</th>
                <th>Hình ảnh</th>
                <th>Mã sản phẩm</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            while ($row = mysqli_fetch_array($query_timkiem)) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row['tensanpham']); ?></td>
                    <td><?php echo number_format($row['giasp'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo number_format($row['giamgia'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo number_format($row['gianhap'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo $row['soluong']; ?></td>
                    <td><?php echo $row['size']; ?></td>
                    <td><?php echo $row['tendanhmuc']; ?></td>
                    <td>
                        <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" 
                             style="width:120px;height:120px;object-fit:contain; border:1px solid #ddd;">
                    </td>
                    <td><?php echo htmlspecialchars($row['masp']); ?></td>
                    <td>
                        <a href="index.php?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Sửa
                        </a>

                        <?php if ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2) { ?>
                            <a href="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        <?php } else { ?>
                            <span class="badge badge-secondary">Không thể xóa</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
