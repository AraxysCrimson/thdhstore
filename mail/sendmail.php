<?php 
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/OAuth.php";
include "PHPMailer/src/POP3.php";
include "PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    public function dathangmail($tieude, $noidung, $maildathang) {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            // Server settings
            $mail->SMTPDebug = 0; // Ẩn log hoàn toàn
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nhom2pvd@gmail.com';
            $mail->Password = 'zygx xemq lycp vwfq';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            
            // Tối ưu kết nối SMTP
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            // Tắt xác thực DNS để tăng tốc
            $mail->SMTPKeepAlive = true;
            
            // Tắt cơ chế xác thực XOAUTH2 không cần thiết
            $mail->AuthType = '';
            
            // Recipients - thiết lập người nhận đơn giản
            $mail->setFrom('nhom2pvd@gmail.com', 'THDH Store');
            $mail->addAddress($maildathang);

            // Content - đơn giản hóa nội dung
            $mail->isHTML(true);
            $mail->Subject = $tieude;
            $mail->Body = $noidung;
            $mail->AltBody = strip_tags($noidung); // Thêm phiên bản text để tăng tốc độ gửi
            
            // Thiết lập timeout ngắn hơn để không chờ quá lâu nếu có vấn đề
            $mail->Timeout = 10; // 10 giây
            
            // Gửi email
            $mail->send();
            
            // Đóng kết nối
            $mail->smtpClose();
            
            return true;
        } catch (Exception $e) {
            // Ghi log lỗi thay vì hiển thị trực tiếp
            error_log('Lỗi khi gửi mail: ' . $mail->ErrorInfo);
            return false;
        }
    }
}
?>
