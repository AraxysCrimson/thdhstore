<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("./admin/config/config.php");
require("./mail/sendmail.php");

$step = 'request_email';

if (isset($_POST['submit_email'])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $sql_check = "SELECT * FROM tbl_dangky WHERE email='$email' LIMIT 1";
    $query_check = mysqli_query($mysqli, $sql_check);

    if (mysqli_num_rows($query_check) > 0) {
        $_SESSION['reset_email'] = $email;
        $otp_code = rand(1000, 9999);
        $_SESSION['otp_code'] = $otp_code;

        $tieude = "🔐 Mã xác nhận đặt lại mật khẩu - THDH Store";
        $noidung = "<p>Mã xác nhận của bạn là: <strong>$otp_code</strong></p>
                    <p>Vui lòng nhập mã này để tiếp tục đặt lại mật khẩu.</p>";
        $mail = new Mailer();
        $mail->dathangmail($tieude, $noidung, $email);

        $step = 'verify_otp';
    } else {
        $error = "📛 Email chưa được đăng ký. Vui lòng kiểm tra lại.";
        $step = 'request_email';
    }
}

if (isset($_POST['submit_otp'])) {
    $entered_otp = $_POST['otp'];
    if ($_SESSION['otp_code'] == $entered_otp) {
        $step = 'reset_password';
    } else {
        $error = "❌ Mã xác nhận không đúng!";
        $step = 'verify_otp';
    }
}

if (isset($_POST['submit_password'])) {
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $confirm = mysqli_real_escape_string($mysqli, $_POST['confirm_password']);

    if ($password !== $confirm) {
        $error = "❌ Mật khẩu xác nhận không khớp!";
        $step = 'reset_password';
    } else {
        $hashed_password = md5($password);
        $email = $_SESSION['reset_email'];
        $sql_update = "UPDATE tbl_dangky SET matkhau='$hashed_password' WHERE email='$email'";
        mysqli_query($mysqli, $sql_update);

        unset($_SESSION['reset_email']);
        unset($_SESSION['otp_code']);
        $step = 'done';
    }
}
?>

<div class="container mt-5">
    <h3 class="text-center mb-4">🔑 Quên Mật Khẩu</h3>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($step == 'request_email'): ?>
        <form method="POST" class="mx-auto" style="max-width: 400px;">
            <div class="form-group">
                <label><i class="fas fa-envelope"></i> Nhập email đã đăng ký:</label>
                <input type="email" name="email" class="form-control" required placeholder="example@gmail.com">
            </div>
            <button type="submit" name="submit_email" class="btn btn-primary btn-block">Gửi mã xác nhận</button>
            <p class="text-center mt-3"><a href="chitiet.php?quanly=dangnhap">← Quay lại đăng nhập</a></p>
        </form>

    <?php elseif ($step == 'verify_otp'): ?>
        <form method="POST" class="mx-auto" style="max-width: 400px;">
            <div class="form-group text-center">
                <label>📩 Nhập mã xác nhận (4 số):</label>
                <input type="number" name="otp" class="form-control text-center" required maxlength="4">
            </div>
            <button type="submit" name="submit_otp" class="btn btn-warning btn-block">Xác nhận</button>
        </form>

    <?php elseif ($step == 'reset_password'): ?>
        <form method="POST" class="mx-auto" style="max-width: 400px;">
            <div class="form-group">
                <label>🔒 Nhập mật khẩu mới:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>🔁 Nhập lại mật khẩu:</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" name="submit_password" class="btn btn-success btn-block">Cập nhật mật khẩu</button>
        </form>

    <?php elseif ($step == 'done'): ?>
        <div class="alert alert-success text-center">
            ✅ Mật khẩu đã được cập nhật thành công!
        </div>
        <div class="text-center">
            <a href="chitiet.php?quanly=dangnhap" class="btn btn-primary">← Quay lại đăng nhập</a>
        </div>
    <?php endif; ?>
</div>
