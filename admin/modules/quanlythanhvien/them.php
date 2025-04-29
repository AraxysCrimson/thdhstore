<?php
// Kiểm tra nếu session chưa khởi tạo thì mới khởi động
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra quyền truy cập
if ($_SESSION['role_id'] != 1) {
    header('Location: index.php');
    exit();
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Thêm Thành Viên</h2>
    <form method="POST" action="modules/quanlythanhvien/xuly.php" onsubmit="return validateForm();">
        <div class="form-group">
            <label>Họ & Tên:</label>
            <input type="text" class="form-control" name="hovaten" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label>Số điện thoại:</label>
            <input type="text" class="form-control" name="dienthoai" required>
        </div>
        <div class="form-group">
            <label>Địa chỉ:</label>
            <input type="text" class="form-control" name="diachi" required>
        </div>
        <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" class="form-control" id="matkhau" name="matkhau" required>
        </div>
        <div class="form-group">
            <label>Xác nhận Mật khẩu:</label>
            <input type="password" class="form-control" id="confirm_matkhau" name="confirm_matkhau" required>
        </div>
        <div class="form-group">
            <label>Chức danh:</label>
            <select class="form-control" name="role_id" required>
                <option value="2">Quản lý</option>
                <option value="3">Nhân viên</option>
                <option value="4">Khách hàng</option>
            </select>
        </div>
        <button type="submit" name="dangky" class="btn btn-success">Thêm Thành Viên</button>
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
