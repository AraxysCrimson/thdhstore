<?php
// Đảm bảo session chỉ được khởi tạo một lần
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bật hiển thị lỗi PHP để kiểm tra
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kết nối database
$root_path = realpath(dirname(__FILE__) . '/../../config/config.php');
if (file_exists($root_path)) {
    include_once($root_path);
} else {
    die("❌ Không thể tải file cấu hình. Kiểm tra lại đường dẫn: $root_path");
}

// Lấy danh sách danh mục sản phẩm
$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);

// Kiểm tra nếu truy vấn SQL có lỗi
if (!$query_lietke_danhmucsp) {
    die("❌ Lỗi MySQL khi lấy danh mục: " . mysqli_error($mysqli));
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4"><i class="fas fa-list"></i> Quản Lý Danh Mục Sản Phẩm</h2>

    <!-- 🟢 Hiển thị thông báo nếu có -->
    <?php if (isset($_SESSION['message'])): ?>
        <div id="alert-box" class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php 
        unset($_SESSION['message']);
        unset($_SESSION['message_type']); 
        ?>
    <?php endif; ?>

    <div class="row">
        <!-- 🟢 Form thêm danh mục -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-plus"></i> Thêm Danh Mục</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="modules/quanlydanhmucsp/xuly.php">
                        <div class="form-group">
                            <label for="tendanhmuc"><strong>Tên Danh Mục:</strong></label>
                            <input type="text" class="form-control" id="tendanhmuc" name="tendanhmuc" required>
                        </div>
                        <div class="form-group">
                            <label for="thutu"><strong>Thứ tự:</strong></label>
                            <input type="number" class="form-control" id="thutu" name="thutu" required>
                        </div>
                        <button type="submit" name="themdanhmuc" class="btn btn-success btn-block">
                            <i class="fas fa-save"></i> Lưu danh mục
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 🟠 Danh sách danh mục -->
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>ID Danh mục</th> <!-- 🔥 Sửa thành ID Danh Mục -->
                            <th colspan="2">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        if (mysqli_num_rows($query_lietke_danhmucsp) == 0) {
                            echo '<tr><td colspan="5" class="text-center text-danger">⚠️ Không có danh mục nào!</td></tr>';
                        } else {
                            while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) { ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo htmlspecialchars($row['tendanhmuc']); ?></td>
                                    <td><?php echo $row['id_danhmuc']; ?></td> <!-- 🔥 Hiện id_danhmuc -->
                                    <td>
                                        <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc']; ?>" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                    </td>
                                    <td>
                                        <a href="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc']; ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                            <i class="fas fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Tự động ẩn thông báo sau 1 giây
setTimeout(function() {
    let alertBox = document.getElementById("alert-box");
    if (alertBox) {
        alertBox.style.transition = "opacity 0.5s";
        alertBox.style.opacity = "0";
        setTimeout(function() {
            alertBox.style.display = "none";
        }, 500);
    }
}, 1000);
</script>
