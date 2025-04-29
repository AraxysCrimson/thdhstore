<?php
// Kiểm tra nếu session chưa khởi tạo thì mới khởi động
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Đảm bảo đường dẫn đúng đến config.php
$root_path = $_SERVER['DOCUMENT_ROOT'] . '/thoitrangnam/admin/config/config.php';
if (file_exists($root_path)) {
    include_once($root_path);
} else {
    die("Không thể tải tệp cấu hình. Vui lòng kiểm tra lại đường dẫn: $root_path");
}

// Kiểm tra quyền truy cập
if ($_SESSION['role_id'] != 1) {
    header('Location: index.php');
    exit();
}

$id = $_GET['iddangky'];
$sql = "SELECT * FROM tbl_dangky WHERE id_dangky = '$id' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Chỉnh sửa Thành Viên</h2>
    <form method="POST" action="modules/quanlythanhvien/xuly.php?iddangky=<?php echo $row['id_dangky'] ?>" onsubmit="return validateForm();">
        <div class="form-group">
            <label>Họ & Tên:</label>
            <input type="text" class="form-control" name="hovaten" value="<?php echo $row['tenkhachhang'] ?>" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" required>
        </div>
        <div class="form-group">
            <label>Số điện thoại:</label>
            <input type="text" class="form-control" name="dienthoai" value="<?php echo $row['dienthoai'] ?>" required>
        </div>
        <div class="form-group">
            <label>Địa chỉ:</label>
            <input type="text" class="form-control" name="diachi" value="<?php echo $row['diachi'] ?>" required>
        </div>
        <div class="form-group">
            <label>Mật khẩu mới (Để trống nếu không thay đổi):</label>
            <input type="password" class="form-control" id="matkhau" name="matkhau">
        </div>
        <div class="form-group">
            <label>Xác nhận Mật khẩu:</label>
            <input type="password" class="form-control" id="confirm_matkhau" name="confirm_matkhau">
        </div>
        <div class="form-group">
            <label>Chức danh:</label>
            <select class="form-control" name="role_id" required>
                <option value="2" <?php if($row['role_id'] == 2) echo 'selected'; ?>>Quản lý</option>
                <option value="3" <?php if($row['role_id'] == 3) echo 'selected'; ?>>Nhân viên</option>
                <option value="4" <?php if($row['role_id'] == 4) echo 'selected'; ?>>Khách hàng</option>
            </select>
        </div>
        <button type="submit" name="suathanhvien" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>

<script>
    function validateForm() {
        var password = document.getElementById("matkhau").value;
        var confirmPassword = document.getElementById("confirm_matkhau").value;

        if (password !== confirmPassword) {
            alert("Mật khẩu xác nhận không khớp!");
            return false;
        }
        return true;
    }
</script>
