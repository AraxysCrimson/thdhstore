<div class="container mt-4">
    <h2 class="text-center mb-4">Thêm Sản Phẩm</h2>
    <form method="POST" action="modules/quanlysp/xuly.php" enctype="multipart/form-data">
        <div class="form-group">
            <label><strong>Mã sản phẩm:</strong></label>
            <input type="text" class="form-control" name="masp" placeholder="Nhập mã sản phẩm..." required>
        </div>
        <div class="form-group">
            <label><strong>Tên sản phẩm:</strong></label>
            <input type="text" class="form-control" name="tensanpham" placeholder="Nhập tên sản phẩm..." required>
        </div>
        <div class="form-group">
            <label><strong>Giá bán:</strong></label>
            <input type="text" class="form-control" name="giasp" required>
        </div>
        <div class="form-group">
            <label><strong>Giảm giá:</strong></label>
            <input type="text" class="form-control" name="giamgia">
        </div>
        <div class="form-group">
            <label><strong>Giá nhập:</strong></label>
            <input type="text" class="form-control" name="gianhap" required>
        </div>
        <div class="form-group">
            <label><strong>Số lượng:</strong></label>
            <input type="text" class="form-control" name="soluong" required>
        </div>
        <div class="form-group">
            <label><strong>Size:</strong></label>
            <input type="text" class="form-control" name="size">
        </div>
        <div class="form-group">
            <label><strong>Danh mục sản phẩm:</strong></label>
            <select class="form-control" name="danhmuc" required>
                <option value="">-- Chọn danh mục --</option>
                <?php
                $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                    echo '<option value="' . $row_danhmuc['id_danhmuc'] . '">' . $row_danhmuc['tendanhmuc'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label><strong>Mô tả sản phẩm:</strong></label>
            <textarea class="form-control" name="noidung" rows="4" placeholder="Nhập mô tả sản phẩm..."></textarea>
        </div>
        <div class="form-group">
            <label><strong>Hình ảnh sản phẩm:</strong></label>
            <input type="file" class="form-control" name="hinhanh" id="uploadImage" accept="image/*" required>
            <img id="previewImage" style="max-width: 150px; margin-top: 10px; display: none;">
        </div>
        <button type="submit" name="themsanpham" class="btn btn-success"><i class="fas fa-plus-circle"></i> Thêm sản phẩm</button>
    </form>
</div>
