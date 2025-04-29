<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) { session_start(); }
include("admin/config/config.php");

$tennguoidung = "";
$email = "";
$dienthoai = "";
$diachi = "";
$thongbao = "";

// Nếu đã đăng nhập
if (isset($_SESSION['id_khachhang'])) {
    $id_khachhang = $_SESSION['id_khachhang'];
    $sql = "SELECT * FROM tbl_dangky WHERE id_dangky = '$id_khachhang' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    if ($query) {
        $user = mysqli_fetch_array($query);
        $tennguoidung = $user['tenkhachhang'];
        $email = $user['email'];
        $dienthoai = $user['dienthoai'];
        $diachi = $user['diachi'];
    }
}

// Xử lý phản hồi
if (isset($_POST['lienhe'])) {
    $tennguoidung = $_POST['hoten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];
    $chude = $_POST['chude'];
    $noidung = $_POST['noidung'];
    $time_lh = date('Y-m-d H:i:s');

    $sql_phanhoi = mysqli_query($mysqli, "INSERT INTO feedback(tennguoidung, email, dienthoai, diachi, chude, noidung, time_lh, status_lh)
        VALUES ('$tennguoidung', '$email', '$dienthoai', '$diachi', '$chude', '$noidung', '$time_lh', 1)");

    if ($sql_phanhoi) {
        $thongbao = '<div id="thongbao" class="alert alert-success text-center shadow">
            ✅ Bạn đã gửi phản hồi thành công! Cảm ơn bạn đã liên hệ với chúng tôi.
        </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .contact-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.1);
        }
        .fade-out {
            transition: opacity 1s ease-out;
        }
        .fade-out.hide {
            opacity: 0;
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <h2 class="text-center text-primary mb-4">Liên hệ và phản hồi với THDH Store</h2>

    <?php if (!empty($thongbao)) echo $thongbao; ?>

    <form method="post">
        <div class="row">
            <!-- Form -->
            <div class="col-md-6">
                <div class="contact-box">
                    <div class="form-group">
                        <label>Họ và Tên</label>
                        <input type="text" class="form-control" name="hoten" placeholder="Nhập Họ & Tên"
                               value="<?php echo htmlspecialchars($tennguoidung); ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Nhập email"
                               value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="tel" class="form-control" name="dienthoai" placeholder="Nhập số điện thoại"
                               value="<?php echo htmlspecialchars($dienthoai); ?>">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" name="diachi" placeholder="Nhập địa chỉ"
                               value="<?php echo htmlspecialchars($diachi); ?>">
                    </div>
                    <div class="form-group">
                        <label>Chủ đề</label>
                        <input type="text" class="form-control" name="chude" placeholder="Nhập chủ đề">
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea class="form-control" rows="4" name="noidung" placeholder="Nhập nội dung"></textarea>
                    </div>
                    <button name="lienhe" class="btn btn-success btn-block">📩 GỬI PHẢN HỒI</button>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="col-md-6">
                <div class="contact-box p-0 overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d983.1786236731634!2d108.8044537304749!3d15.105583624259702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3169ad9452eafa21%3A0x82c379a8fc102db0!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buTQyBQaOG6p20gVsSDbiDEkOG7q25n!5e1!3m2!1svi!2s!4v1707453805703!5m2!1svi!2s"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Ẩn thông báo sau 5 giây
    setTimeout(() => {
        const tb = document.getElementById("thongbao");
        if (tb) {
            tb.classList.add("fade-out", "hide");
            setTimeout(() => tb.remove(), 1000);
        }
    }, 5000);
</script>

<?php ob_end_flush(); ?>
</body>
</html>
