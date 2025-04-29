<?php
include("admin/config/config.php");
require("./mail/sendmail.php");

$otp_verified = false;
$otp_message = "";
$error = "";
$success = false;

$tenkhachhang = $_POST['hovaten'] ?? '';
$email = $_POST['email'] ?? '';
$dienthoai = $_POST['dienthoai'] ?? '';
$diachi = $_POST['diachi'] ?? '';

$matkhau = $_POST['matkhau'] ?? ($_SESSION['cached_password'] ?? '');
$matkhau_xacnhan = $_POST['confirmation_pwd'] ?? ($_SESSION['cached_confirm'] ?? '');

if (isset($_POST['send_otp']) || isset($_POST['verify_otp'])) {
    $_SESSION['cached_password'] = $_POST['matkhau'] ?? '';
    $_SESSION['cached_confirm'] = $_POST['confirmation_pwd'] ?? '';
}

if (isset($_POST['dangky'])) {
    unset($_SESSION['cached_password']);
    unset($_SESSION['cached_confirm']);
}

if (isset($_POST['send_otp'])) {
    $email = $_POST['email'];
    $_SESSION['register_email'] = $email;
    $otp_code = rand(1000, 9999);
    $_SESSION['otp_code_register'] = $otp_code;

    $tieude = "📧 Mã xác thực tài khoản - THDH Store";
    $noidung = "<p>Mã xác thực tài khoản của bạn là: <strong>$otp_code</strong></p>
                <p>Vui lòng nhập mã này trong biểu mẫu đăng ký để tiếp tục.</p>";
    $mail = new Mailer();
    $mail->dathangmail($tieude, $noidung, $email);

    $otp_message = '<div class="alert alert-info">📩 Mã xác thực đã được gửi về email của bạn. <br>📥 Nếu không thấy, vui lòng kiểm tra cả hộp thư rác (Spam).</div>';
}

if (isset($_POST['verify_otp'])) {
    $user_otp = $_POST['otp'];
    if ($_SESSION['otp_code_register'] == $user_otp) {
        $_SESSION['otp_verified'] = true;
        $otp_message = '<div class="alert alert-success">✅ Xác thực email thành công!</div>';
    } else {
        $otp_message = '<div class="alert alert-danger">❌ Mã xác thực không đúng!</div>';
    }
}

if (isset($_SESSION['otp_verified']) && $_SESSION['otp_verified'] === true) {
    $otp_verified = true;
}

if (isset($_POST['dangky']) && $otp_verified) {
    $matkhau = md5($_POST['matkhau']);

    $sql_check_email = mysqli_query($mysqli, "SELECT * FROM tbl_dangky WHERE email = '$email'");
    $count_email = mysqli_num_rows($sql_check_email);

    $sql_check_phone = mysqli_query($mysqli, "SELECT * FROM tbl_dangky WHERE dienthoai = '$dienthoai'");
    $count_phone = mysqli_num_rows($sql_check_phone);

    if ($count_email > 0) {
        $error = '<div class="alert alert-danger">Email này đã được đăng ký!</div>';
    } else if ($count_phone > 0) {
        $error = '<div class="alert alert-danger">Số điện thoại này đã được đăng ký!</div>';
    } else {
        $sql_dangky = mysqli_query($mysqli,
            "INSERT INTO tbl_dangky(tenkhachhang, email, dienthoai, matkhau, diachi, role_id) 
             VALUES ('$tenkhachhang', '$email', '$dienthoai', '$matkhau', '$diachi', 4)"
        );

        if ($sql_dangky) {
            $success = true;
            $error = '<div class="alert alert-success" id="successMessage">Đăng ký thành công! Đang chuyển hướng đến trang đăng nhập...</div>';
            unset($_SESSION['otp_code_register']);
            unset($_SESSION['otp_verified']);
            unset($_SESSION['register_email']);
            echo '<script>
                setTimeout(function(){
                    window.location.href = "http://localhost/thoitrangnam/chitiet.php?quanly=dangnhap";
                }, 2000);
            </script>';
        } else {
            $error = '<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại!</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng Ký</title>
    <link rel="icon" type="image/png" href="https://gokisoft.com/uploads/2021/03/s-568-ico-web.jpg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: url('https://source.unsplash.com/1920x1080/?nature,abstract') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 420px;
            text-align: center;
        }
        .form-control {
            border-radius: 8px;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0px 0px 10px rgba(40, 167, 69, 0.6);
        }
        .btn-register {
            background: #28a745;
            color: white;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
        }
        .btn-register:hover {
            background: #218838;
        }
        .extra-links {
            margin-top: 15px;
        }
        .extra-links a {
            text-decoration: none;
            font-weight: bold;
            color: #007bff;
        }
        .extra-links a:hover {
            text-decoration: underline;
        }
        .input-group-text {
            cursor: pointer;
            background: white;
            border-left: none;
        }
        .form-control {
            border-right: none;
        }
    </style>
</head>
<body>
<div class="register-container">
    <div class="register-box">
        <h2>📝 Đăng Ký Tài Khoản</h2>
        <p>Điền thông tin để tạo tài khoản</p>
        <?php echo $error; ?>
        <?php echo $otp_message; ?>
        <form method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label><i class="fas fa-user"></i> Họ & Tên:</label>
                <input required type="text" class="form-control" name="hovaten" value="<?= htmlspecialchars($tenkhachhang) ?>" placeholder="Nhập Họ & Tên">
            </div>
            <div class="form-group">
                <label><i class="fas fa-envelope"></i> Email:</label>
                <input required type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Nhập email">
                <div class="mt-2">
                    <button type="submit" name="send_otp" class="btn btn-info btn-sm">📨 Gửi mã xác thực</button>
                </div>
            </div>
            <div class="form-group">
                <label><i class="fas fa-shield-alt"></i> Mã xác thực (4 số):</label>
                <div class="input-group">
                    <input type="text" name="otp" maxlength="4" class="form-control" placeholder="Nhập mã xác nhận">
                    <div class="input-group-append">
                        <button type="submit" name="verify_otp" class="btn btn-secondary">Xác nhận</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><i class="fas fa-phone"></i> Số điện thoại:</label>
                <input required type="tel" class="form-control" name="dienthoai" pattern="[0-9]{10}" title="Vui lòng nhập số điện thoại 10 số" value="<?= htmlspecialchars($dienthoai) ?>" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group">
                <label><i class="fas fa-map-marker-alt"></i> Địa chỉ:</label>
                <input required type="text" class="form-control" name="diachi" value="<?= htmlspecialchars($diachi) ?>" placeholder="Nhập địa chỉ">
            </div>
            <div class="form-group">
                <label><i class="fas fa-lock"></i> Mật Khẩu:</label>
                <div class="input-group">
                    <input required type="password" id="password" class="form-control" name="matkhau" minlength="6" value="<?= htmlspecialchars($matkhau) ?>">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword()">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><i class="fas fa-check"></i> Xác Minh Mật Khẩu:</label>
                <input required type="password" class="form-control" id="confirmation_pwd" name="confirmation_pwd" minlength="6" value="<?= htmlspecialchars($matkhau_xacnhan) ?>">
            </div>
            <button type="submit" name="dangky" class="btn btn-register" <?= !$otp_verified ? 'disabled' : '' ?>>
                <i class="fas fa-user-plus"></i> Đăng ký
            </button>
        </form>
        <div class="extra-links">
            <p><a href="chitiet.php?quanly=dangnhap"><i class="fas fa-sign-in-alt"></i> Đã có tài khoản? Đăng nhập</a></p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validateForm() {
        var pwd = $('#password').val();
        var confirmPwd = $('#confirmation_pwd').val();
        if (pwd !== confirmPwd) {
            alert("Mật khẩu không khớp, vui lòng kiểm tra lại!");
            return false;
        }
        return true;
    }

    function togglePassword() {
        var passwordField = document.getElementById("password");
        var icon = document.getElementById("toggleIcon");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.replace("fa-eye-slash", "fa-eye");
        }
    }
</script>
</body>
</html>