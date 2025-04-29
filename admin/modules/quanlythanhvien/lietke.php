<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Lấy danh sách nhân viên & quản lý
$sql_nhanvien = "SELECT * FROM tbl_dangky INNER JOIN tbl_role ON tbl_role.id_role = tbl_dangky.role_id 
                 WHERE tbl_dangky.role_id IN (2,3) ORDER BY id_dangky";
$query_nhanvien = mysqli_query($mysqli, $sql_nhanvien);

// Lấy danh sách khách hàng
$sql_khachhang = "SELECT * FROM tbl_dangky WHERE role_id = 4 ORDER BY id_dangky";
$query_khachhang = mysqli_query($mysqli, $sql_khachhang);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thành Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script>
        function confirmAction(message, url) {
            if (confirm(message)) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
<div class="container mt-4">

    <!-- Bảng Nhân Viên & Quản Lý -->
    <h2 class="text-center mb-4"><i class="fas fa-users"></i> Quản lý Nhân Viên & Quản Lý</h2>

    <?php if ($_SESSION['role_id'] == 1) { ?>
        <div class="text-right mb-3">
            <a href="index.php?action=quanlythanhvien&query=them" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Thêm Nhân Viên
            </a>
        </div>
    <?php } ?>

    <table class="table table-bordered table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Quyền</th>
                <th>Trạng thái</th>
                <?php if ($_SESSION['role_id'] == 1) { ?>
                    <th colspan="3">Quản lý</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 0;
            while($row_nv = mysqli_fetch_array($query_nhanvien)){
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_nv['tenkhachhang'] ?></td>
                    <td><?php echo $row_nv['email'] ?></td>
                    <td><?php echo $row_nv['dienthoai'] ?></td>
                    <td><?php echo $row_nv['diachi'] ?></td>
                    <td><?php echo $row_nv['name'] ?></td>
                    <td><?php echo ($row_nv['trangthai'] == 1) ? 'Hoạt động' : 'Bị chặn'; ?></td>
                    
                    <?php if ($_SESSION['role_id'] == 1) { ?>
                    <td>
                        <a href="?action=quanlythanhvien&query=sua&iddangky=<?php echo $row_nv['id_dangky']?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                    </td>
                    <td>
                        <a href="#" onclick="confirmAction('Bạn có chắc chắn muốn xóa thành viên này không?', 'modules/quanlythanhvien/xuly.php?delete=<?php echo $row_nv['id_dangky']; ?>')" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </td>
                    <td>
                        <a href="#" onclick="confirmAction('Bạn có chắc chắn muốn chặn/mở khóa tài khoản này không?', 'modules/quanlythanhvien/xuly.php?block=<?php echo $row_nv['id_dangky']; ?>')" class="btn btn-secondary">
                            <?php echo ($row_nv['trangthai'] == 1) ? '<i class="fas fa-ban"></i> Chặn' : '<i class="fas fa-check"></i> Mở khóa'; ?>
                        </a>
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Bảng Khách Hàng -->
    <h2 class="text-center mt-5"><i class="fas fa-user"></i> Quản lý Khách Hàng</h2>
    <table class="table table-bordered table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <?php if ($_SESSION['role_id'] == 1) { ?>
                    <th colspan="3">Quản lý</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 0;
            while($row_kh = mysqli_fetch_array($query_khachhang)){
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_kh['tenkhachhang'] ?></td>
                    <td><?php echo $row_kh['email'] ?></td>
                    <td><?php echo $row_kh['dienthoai'] ?></td>
                    <td><?php echo $row_kh['diachi'] ?></td>
                    <td><?php echo ($row_kh['trangthai'] == 1) ? 'Hoạt động' : 'Bị chặn'; ?></td>
                    
                    <?php if ($_SESSION['role_id'] == 1) { ?>
                    <td>
                        <a href="?action=quanlythanhvien&query=sua&iddangky=<?php echo $row_kh['id_dangky']?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                    </td>
                    <td>
                        <a href="#" onclick="confirmAction('Bạn có chắc chắn muốn xóa khách hàng này không?', 'modules/quanlythanhvien/xuly.php?delete=<?php echo $row_kh['id_dangky']; ?>')" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </td>
                    <td>
                        <a href="#" onclick="confirmAction('Bạn có chắc chắn muốn chặn/mở khóa khách hàng này không?', 'modules/quanlythanhvien/xuly.php?block=<?php echo $row_kh['id_dangky']; ?>')" class="btn btn-secondary">
                            <?php echo ($row_kh['trangthai'] == 1) ? '<i class="fas fa-ban"></i> Chặn' : '<i class="fas fa-check"></i> Mở khóa'; ?>
                        </a>
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
</body>
</html>
