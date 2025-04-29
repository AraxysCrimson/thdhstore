<?php
// Kết nối database
$root_path = realpath(dirname(__FILE__) . '/../../config/config.php');
if (file_exists($root_path)) {
    include_once($root_path);
} else {
    die("❌ Không thể tải file cấu hình. Kiểm tra lại đường dẫn: $root_path");
}

// Kiểm tra nếu có ID sản phẩm cần sửa
if (!isset($_GET['idsanpham'])) {
    die("❌ Không có ID sản phẩm!");
}
$id_sanpham = mysqli_real_escape_string($mysqli, $_GET['idsanpham']);

// Lấy thông tin sản phẩm
$sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id_sanpham' LIMIT 1";
$query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);
$row = mysqli_fetch_array($query_sua_sp);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4"><i class="fas fa-edit"></i> Chỉnh sửa sản phẩm</h2>
    <form method="POST" action="modules/quanlysp/xuly.php?idsanpham=<?php echo $id_sanpham; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label><strong>Mã sản phẩm:</strong></label>
            <input type="text" class="form-control" name="masp" value="<?php echo htmlspecialchars($row['masp']); ?>" required>
        </div>
        <div class="form-group">
            <label><strong>Tên sản phẩm:</strong></label>
            <input type="text" class="form-control" name="tensanpham" value="<?php echo htmlspecialchars($row['tensanpham']); ?>" required>
        </div>
        <div class="form-group">
            <label><strong>Giá bán:</strong></label>
            <input type="text" class="form-control" name="giasp" value="<?php echo $row['giasp']; ?>" required>
        </div>
        <div class="form-group">
            <label><strong>Giảm giá:</strong></label>
            <input type="text" class="form-control" name="giamgia" value="<?php echo $row['giamgia']; ?>">
        </div>
        <div class="form-group">
            <label><strong>Giá nhập:</strong></label>
            <input type="text" class="form-control" name="gianhap" value="<?php echo $row['gianhap']; ?>" required>
        </div>
        <div class="form-group">
            <label><strong>Số lượng:</strong></label>
            <input type="text" class="form-control" name="soluong" value="<?php echo $row['soluong']; ?>" required>
        </div>
        <div class="form-group">
            <label><strong>Size:</strong></label>
            <input type="text" class="form-control" name="size" value="<?php echo $row['size']; ?>">
        </div>
        <div class="form-group">
            <label><strong>Danh mục sản phẩm:</strong></label>
            <select class="form-control" name="danhmuc" required>
                <option value="">-- Chọn --</option>
                <?php
                $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                    $selected = ($row_danhmuc['id_danhmuc'] == $row['id_danhmuc']) ? 'selected' : '';
                    echo '<option value="' . $row_danhmuc['id_danhmuc'] . '" ' . $selected . '>' . $row_danhmuc['tendanhmuc'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label><strong>Mô tả sản phẩm:</strong></label>
            <textarea class="form-control" name="noidung" rows="4"><?php echo htmlspecialchars($row['noidung']); ?></textarea>
        </div>
        <div class="form-group">
            <label><strong>Hình ảnh sản phẩm:</strong></label>
            <input type="file" class="form-control" name="hinhanh" id="uploadImage" accept="image/*">
            <img id="previewImage" src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" 
                 style="max-width: 150px; margin-top: 10px; border:1px solid #ddd;">
        </div>
        <button type="submit" name="suasanpham" class="btn btn-success">
            <i class="fas fa-save"></i> Lưu thay đổi
        </button>
    </form>
</div>

<script>
document.getElementById("uploadImage").onchange = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById("previewImage");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};
</script>
