<?php
use Carbon\Carbon;
session_start();
include('../../admin/config/config.php');
require('../../mail/sendmail.php');
require('../../carbon/autoload.php');
use Carbon\CarbonInterval;

if (!isset($_SESSION['dangky'])) {
    echo "<script>
        alert('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!');
        window.location.href='../../chitiet.php?quanly=dangnhap';
    </script>";
    exit();
}   
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Ho_Chi_Minh');
$now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

if (!isset($_SESSION['id_khachhang'])) {
    echo "<script>alert('Vui lòng đăng nhập để thanh toán!'); window.location.href='../../chitiet.php?quanly=dangnhap';</script>";
    exit();
}

$id_khachhang = $_SESSION['id_khachhang'];
$code_order = rand(1000, 9999);

$hinhthuc = "";
if (isset($_POST['payment_method']) && $_POST['payment_method'] === 'cod') {
    $hinhthuc = "COD";
} elseif (isset($_POST['payment_method']) && $_POST['payment_method'] === 'momo') {
    $tongtien = $_POST['tongtien'] ?? 0;
    echo "<script>window.location.href='../../momo.php?orderId=$code_order&tongtien=$tongtien';</script>";
    exit();
} else {
    echo "<script>alert('Không xác định được phương thức thanh toán'); window.location.href='../../chitiet.php?quanly=giohang';</script>";
    exit();
}

if (empty($_SESSION['cart'])) {
    echo "<script>alert('Giỏ hàng của bạn đang trống!'); window.location.href='../../chitiet.php?quanly=giohang';</script>";
    exit();
}

mysqli_autocommit($mysqli, FALSE);

$insert_cart = "INSERT INTO tbl_cart(id_khachhang, code_cart, cart_status, updata_time) 
                VALUES ('$id_khachhang', '$code_order', 1, '$now')";
$cart_query = mysqli_query($mysqli, $insert_cart);

if ($cart_query) {
    foreach ($_SESSION['cart'] as $value) {
        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];
        
        // Lấy size_id cho sản phẩm cụ thể
        $size_id = isset($_POST['size_ids'][$id_sanpham]) ? $_POST['size_ids'][$id_sanpham] : null;
        
        if (!$size_id) {
            mysqli_rollback($mysqli);
            echo "<script>alert('Vui lòng chọn kích thước cho tất cả sản phẩm!'); window.location.href='../../chitiet.php?quanly=giohang';</script>";
            exit();
        }
        
        $insert_order_details = "INSERT INTO tbl_cart_details(id_sanpham, code_cart, soluongmua, size_id) 
                                 VALUES ('$id_sanpham', '$code_order', '$soluong', '$size_id')";

        $update_kho = "UPDATE tbl_sanpham SET soluong = soluong - $soluong WHERE id_sanpham = $id_sanpham";

        if (!mysqli_query($mysqli, $insert_order_details) || !mysqli_query($mysqli, $update_kho)) {
            mysqli_rollback($mysqli);
            echo "<script>alert('Lỗi khi xử lý đơn hàng.'); window.location.href='../../chitiet.php?quanly=giohang';</script>";
            exit();
        }
    }

    mysqli_commit($mysqli);
    mysqli_autocommit($mysqli, TRUE);

    // Lấy thông tin người dùng
    $sql_get_user = "SELECT * FROM tbl_dangky WHERE id_dangky = '$id_khachhang' LIMIT 1";
    $query_user = mysqli_query($mysqli, $sql_get_user);
    $user_info = mysqli_fetch_array($query_user);
    $ten_khachhang = $user_info['tenkhachhang'];
    $diachi = $user_info['diachi'];
    $dienthoai = $user_info['dienthoai'];
    
    // Định dạng ngày đặt hàng
    $ngay_dat_hang = date('d/m/Y H:i');
    
    // Tính tổng tiền
    $tong_thanh_toan = 0;
    foreach ($_SESSION['cart'] as $val) {
        $tong_thanh_toan += $val['giamgia'] * $val['soluong'];
    }
    
    // Thiết lập tiêu đề và ghi chú thanh toán dựa trên phương thức thanh toán
    $tieude = "Đặt hàng thành công tại THDH Store";
    $payment_note = "";
    
    if ($hinhthuc === "COD") {
        $payment_method_text = "Thanh toán khi nhận hàng (COD)";
        $payment_note = "Vui lòng thanh toán khi đơn hàng được giao đến địa chỉ đã đăng ký.";
    } else {
        $payment_method_text = "Đã thanh toán qua ví MoMo";
        $payment_note = "Bạn đã thanh toán thành công. Đơn hàng sẽ được xử lý và giao đến bạn sớm nhất!";
    }
    
    // Tạo nội dung HTML cho email
    $noidung = '
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đặt hàng thành công</title>
        <style>
            body {
                font-family: "Segoe UI", Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                margin: 0;
                padding: 0;
                background-color: #f7f7f7;
            }
            .container {
                max-width: 650px;
                margin: 0 auto;
                padding: 40px 30px;
                background-color: #ffffff;
                border-radius: 12px;
                box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            }
            .logo {
                text-align: center;
                margin-bottom: 30px;
            }
            .logo h1 {
                color: #4a6cf7;
                margin: 0;
                font-size: 32px;
                font-weight: 700;
                letter-spacing: -0.5px;
            }
            .header {
                text-align: center;
                padding-bottom: 30px;
                border-bottom: 1px solid #eaeaea;
            }
            .header h2 {
                color: #222;
                margin: 0;
                font-size: 26px;
                font-weight: 600;
                letter-spacing: -0.3px;
            }
            .content {
                padding: 30px 0;
            }
            .greeting {
                font-size: 18px;
                margin-bottom: 20px;
                color: #333;
                font-weight: 500;
            }
            .message {
                margin-bottom: 30px;
                color: #555;
                font-size: 16px;
                line-height: 1.7;
            }
            .team-signature {
                font-weight: 600;
                color: #444;
                margin-bottom: 30px;
                font-size: 17px;
            }
            .button-container {
                text-align: center;
                margin: 35px 0;
            }
            .button {
                display: inline-block;
                background-color: #4a6cf7;
                color: white;
                padding: 14px 32px;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 16px;
                transition: background-color 0.3s;
                letter-spacing: 0.3px;
            }
            .button:hover {
                background-color: #3a5ce5;
            }
            .order-info {
                margin: 35px 0;
                background-color: #f9f9f9;
                border-radius: 10px;
                padding: 25px;
                border: 1px solid #eaeaea;
            }
            .order-title {
                font-weight: 600;
                font-size: 20px;
                margin-bottom: 20px;
                color: #333;
                border-bottom: 1px solid #eaeaea;
                padding-bottom: 15px;
            }
            .product {
                margin-bottom: 20px;
                border-bottom: 1px solid #eaeaea;
                padding-bottom: 20px;
            }
            .product:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }
            .product-details {
                display: flex;
                flex-direction: column;
            }
            .product-name {
                font-weight: 600;
                font-size: 17px;
                margin-bottom: 8px;
                color: #222;
            }
            .product-variant {
                color: #666;
                margin-bottom: 10px;
                font-size: 15px;
            }
            .price {
                font-weight: 600;
                font-size: 16px;
                color: #111;
            }
            .order-meta {
                margin: 30px 0;
                display: flex;
                flex-direction: column;
                gap: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                padding: 25px;
                border: 1px solid #eaeaea;
            }
            .order-meta-item {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }
            .order-meta-label {
                font-weight: 600;
                color: #555;
                font-size: 16px;
            }
            .order-meta-value {
                color: #333;
                font-size: 17px;
            }
            .payment-note {
                margin-top: 15px;
                padding: 15px;
                background-color: ' . ($hinhthuc === "COD" ? '#fff8e1' : '#e1f5fe') . ';
                border-radius: 8px;
                border-left: 4px solid ' . ($hinhthuc === "COD" ? '#ffc107' : '#29b6f6') . ';
                color: #555;
                font-size: 16px;
            }
            .total-section {
                background-color: #f9f9f9;
                padding: 25px;
                border-radius: 10px;
                margin-top: 30px;
                border: 1px solid #eaeaea;
            }
            .total-section-title {
                font-weight: 600;
                font-size: 20px;
                margin-bottom: 20px;
                color: #333;
                border-bottom: 1px solid #eaeaea;
                padding-bottom: 15px;
            }
            .total-row {
                display: flex;
                justify-content: space-between;
                font-size: 16px;
                padding: 12px 0;
                border-bottom: 1px solid #eaeaea;
            }
            .total-row:last-child {
                border-bottom: none;
                font-weight: 600;
                font-size: 18px;
                padding-top: 15px;
                color: #222;
            }
            .address {
                margin-top: 30px;
                padding: 25px;
                background-color: #f9f9f9;
                border-radius: 10px;
                border: 1px solid #eaeaea;
            }
            .address-title {
                font-weight: 600;
                font-size: 20px;
                margin-bottom: 20px;
                color: #333;
                border-bottom: 1px solid #eaeaea;
                padding-bottom: 15px;
            }
            .address-content {
                color: #555;
                line-height: 1.7;
                font-size: 16px;
            }
            .address-content p {
                margin: 8px 0;
            }
            .contact-info {
                margin-top: 30px;
                padding: 25px;
                background-color: #f0f4ff;
                border-radius: 10px;
                border: 1px solid #d8e1ff;
            }
            .contact-title {
                font-weight: 600;
                font-size: 20px;
                margin-bottom: 20px;
                color: #4a6cf7;
                border-bottom: 1px solid #d8e1ff;
                padding-bottom: 15px;
            }
            .contact-item {
                display: flex;
                align-items: center;
                margin-bottom: 15px;
            }
            .contact-icon {
                width: 24px;
                margin-right: 15px;
                color: #4a6cf7;
                text-align: center;
            }
            .contact-text {
                color: #444;
                font-size: 16px;
            }
            .contact-text a {
                color: #4a6cf7;
                text-decoration: none;
            }
            .footer {
                text-align: center;
                margin-top: 40px;
                color: #888;
                font-size: 14px;
                border-top: 1px solid #eaeaea;
                padding-top: 30px;
            }
            .footer p {
                margin: 5px 0;
            }
            .social-links {
                margin-top: 20px;
            }
            .social-links a {
                display: inline-block;
                margin: 0 10px;
                color: #4a6cf7;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">
                <h1>THDH Store</h1>
            </div>
            <div class="header">
                <h2>Đặt hàng thành công</h2>
            </div>
            <div class="content">
                <p class="greeting">Xin chào ' . $ten_khachhang . '!</p>
                <p class="message">Cảm ơn bạn đã đặt hàng tại THDH Store. Đơn hàng của bạn đã được xác nhận và đang được xử lý.</p>
                <p class="team-signature">Đội ngũ THDH Store</p>
                
                <div class="button-container">
                    <a href="http://localhost/thoitrangnam/chitiet.php?quanly=giohang" class="button">Theo dõi đơn hàng của bạn</a>
                </div>
                
                <div class="order-info">
                    <div class="order-title">Chi tiết sản phẩm</div>';
    
    // Thêm thông tin sản phẩm
    foreach ($_SESSION['cart'] as $val) {
        $noidung .= '
                    <div class="product">
                        <div class="product-details">
                            <div class="product-name">' . $val['tensanpham'] . '</div>
                            <div class="product-variant">Mã: ' . $val['masp'] . '</div>
                            <div class="price">' . number_format($val['giamgia'], 0, ',', '.') . '₫ × ' . $val['soluong'] . '</div>
                        </div>
                    </div>';
    }
    
    $noidung .= '
                </div>
                
                <div class="order-meta">
                    <div class="order-meta-item">
                        <span class="order-meta-label">Mã đơn hàng:</span>
                        <span class="order-meta-value">' . $code_order . '</span>
                    </div>
                    
                    <div class="order-meta-item">
                        <span class="order-meta-label">Ngày đặt hàng:</span>
                        <span class="order-meta-value">' . $ngay_dat_hang . '</span>
                    </div>
                    
                    <div class="order-meta-item">
                        <span class="order-meta-label">Phương thức thanh toán:</span>
                        <span class="order-meta-value">' . $payment_method_text . '</span>
                    </div>
                    
                    <div class="payment-note">
                        <strong>Ghi chú:</strong> ' . $payment_note . '
                    </div>
                </div>
                
                <div class="total-section">
                    <div class="total-section-title">Tóm tắt đơn hàng</div>
                    <div class="total-row">
                        <span>Tổng thanh toán</span>
                        <span>' . number_format($tong_thanh_toan, 0, ',', '.') . '₫</span>
                    </div>
                </div>
                
                <div class="address">
                    <div class="address-title">Địa chỉ vận chuyển</div>
                    <div class="address-content">
                        <p><strong>' . $ten_khachhang . '</strong></p>
                        <p>(+84) ' . substr($dienthoai, 0, 2) . ' ****** ' . substr($dienthoai, -2) . '</p>
                        <p>' . $diachi . '</p>
                    </div>
                </div>
                
                <div class="contact-info">
                    <div class="contact-title">Cần hỗ trợ?</div>
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <div class="contact-text">0365790125</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-text"><a href="mailto:nhom2pvd@gmail.com">nhom2pvd@gmail.com</a></div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🌐</div>
                        <div class="contact-text"><a href="http://localhost/thoitrangnam/">thdhstore.com</a></div>
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <p>© ' . date('Y') . ' THDH Store. Tất cả các quyền được bảo lưu.</p>
                <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua thông tin bên trên.</p>
                <div class="social-links">
                    <a href="#">Facebook</a>
                    <a href="#">Instagram</a>
                    <a href="#">TikTok</a>
                </div>
            </div>
        </div>
    </body>
    </html>';

    $maildathang = $_SESSION['email'];
    $mail = new Mailer();
    $mail->dathangmail($tieude, $noidung, $maildathang);

    // Lưu mã đơn hàng để hiển thị lịch sử sau khi reload giỏ hàng
    $_SESSION['last_order_code'] = $code_order;

    // Xoá giỏ hàng sau khi lưu lịch sử
    unset($_SESSION['cart']);

    // Quay về trang cảm ơn
    echo "<script>window.location.href='../../indexs.php?quanly=camon';</script>";
    exit();
} else {
    mysqli_rollback($mysqli);
    echo "<script>alert('Lỗi khi tạo đơn hàng.'); window.location.href='../../chitiet.php?quanly=giohang';</script>";
    exit();
}
?>
