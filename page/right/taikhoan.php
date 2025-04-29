<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("admin/config/config.php");

if (!isset($_SESSION['id_khachhang'])) {
    header("Location: index.php");
    exit();
}

$id_khachhang = $_SESSION['id_khachhang'];
$success_message = "";

// Xử lý cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten = mysqli_real_escape_string($mysqli, $_POST['tenkhachhang']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $dienthoai = mysqli_real_escape_string($mysqli, $_POST['dienthoai']);
    $diachi = mysqli_real_escape_string($mysqli, $_POST['diachi']);
    $matkhau = $_POST['matkhau'];

    if (!empty($matkhau)) {
        $hashed_password = md5($matkhau);
        $sql_update = "UPDATE tbl_dangky 
                       SET tenkhachhang='$ten', email='$email', dienthoai='$dienthoai', diachi='$diachi', matkhau='$hashed_password' 
                       WHERE id_dangky='$id_khachhang'";
    } else {
        $sql_update = "UPDATE tbl_dangky 
                       SET tenkhachhang='$ten', email='$email', dienthoai='$dienthoai', diachi='$diachi' 
                       WHERE id_dangky='$id_khachhang'";
    }

    if (mysqli_query($mysqli, $sql_update)) {
        $success_message = "Cập nhật thành công!";
    }
}

$sql = "SELECT * FROM tbl_dangky WHERE id_dangky = '$id_khachhang' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$result = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tài khoản của bạn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .fade-out {
            transition: opacity 1s ease-out;
            opacity: 1;
        }
        .fade-out.hide {
            opacity: 0;
        }
        .profile-container {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .form-title {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body style="background-color: #f2f4f8;">

<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Form cập nhật tài khoản -->
        <div class="col-md-8">
            <div class="profile-container">
                <div class="text-center mb-4">
                    <img class="rounded-circle" width="120px"
                         src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <h3 class="mt-2"><?php echo $result['tenkhachhang']; ?></h3>
                    <p class="text-muted"><?php echo $result['email']; ?></p>
                </div>

                <form method="POST">
                    <h4 class="form-title text-center">Thông tin tài khoản</h4>

                    <?php if (!empty($success_message)): ?>
                        <div id="successMessage" class="alert alert-success text-center fade-out">
                            ✅ <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" name="tenkhachhang" value="<?php echo $result['tenkhachhang']; ?>" required>

                            <label class="form-label mt-3">Số điện thoại</label>
                            <input type="text" class="form-control" name="dienthoai" value="<?php echo $result['dienthoai']; ?>" required>

                            <label class="form-label mt-3">Mật khẩu mới</label>
                            <input type="password" class="form-control" name="matkhau" placeholder="Để trống nếu không đổi">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="diachi" value="<?php echo $result['diachi']; ?>" required>

                            <label class="form-label mt-3">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $result['email']; ?>" required>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary px-5" type="submit">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Khuyến mãi dành cho bạn -->
        <div class="col-md-4">
            <div class="profile-container h-100">
                <h4 class="text-center">🎁 Khuyến mãi dành cho bạn</h4>
                <ul class="list-unstyled mt-3">
                    <li>✨ Mã giảm giá 10% cho đơn đầu tiên</li>
                    <li>🚚 Miễn phí vận chuyển với đơn từ 500.000đ</li>
                    <li>🔥 Flash Sale mỗi tối lúc 20h00</li>
                </ul>
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-warning btn-block">Khám phá ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Ẩn thông báo sau 5 giây
    window.addEventListener('DOMContentLoaded', function () {
        const msg = document.getElementById('successMessage');
        if (msg) {
            setTimeout(() => {
                msg.classList.add('hide');
                setTimeout(() => msg.style.display = 'none', 1000);
            }, 5000);
        }
    });
</script>
</body>
</html>
