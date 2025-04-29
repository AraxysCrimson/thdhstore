<?php
if (isset($_POST["dangnhap"])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $matkhau = md5($_POST['password']);

    // Truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM tbl_dangky WHERE email=? AND matkhau=? LIMIT 1";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $matkhau);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row_data = mysqli_fetch_array($result);
        
        // Kiểm tra trạng thái tài khoản
        if ($row_data['trangthai'] == 0) {
            $error = '<div class="alert alert-danger text-center" role="alert">
                        <i class="fas fa-ban"></i> Tài khoản của bạn đã bị chặn! Vui lòng liên hệ quản trị viên.
                      </div>';
        } else {
            $_SESSION['dangky'] = $row_data['tenkhachhang'];
            $_SESSION['id_khachhang'] = $row_data['id_dangky'];
            $_SESSION['role_id'] = $row_data['role_id'];
            $_SESSION['email'] = $row_data['email'];

            // Kiểm tra quyền và điều hướng
            if ($row_data['role_id'] == 1) {
                $message = 'Đăng nhập admin thành công! Đang chuyển hướng...';
                $redirect = "admin/indexs.php";
            } else if ($row_data['role_id'] == 2) {
                $message = 'Đăng nhập quản lý thành công! Đang chuyển hướng...';
                $redirect = "admin/indexs.php";
            } else if ($row_data['role_id'] == 3) {
                $message = 'Đăng nhập nhân viên thành công! Đang chuyển hướng...';
                $redirect = "admin/indexs.php";
            } else {
                $message = 'Đăng nhập thành công! Đang chuyển hướng...';
                $redirect = "index.php";
            }

            echo '<div class="alert alert-success text-center" role="alert">
                    ' . $message . '
                  </div>';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "' . $redirect . '";
                    }, 1500);
                  </script>';
            exit();
        }
    } else {
        $error = '<div class="alert alert-danger text-center" role="alert">
                    <i class="fas fa-exclamation-circle"></i> Tài khoản hoặc Mật khẩu không đúng, vui lòng nhập lại.
                  </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="icon" type="image/png" href="https://gokisoft.com/uploads/2021/03/s-568-ico-web.jpg" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background: url('https://source.unsplash.com/random/1920x1080?nature') no-repeat center center fixed;
            background-size: cover;
            margin: 0; /* Loại bỏ khoảng trắng mặc định của trình duyệt */
            padding: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 150px); /* Giảm chiều cao để phù hợp với header */
            margin-top: -50px; /* Đẩy form lên trên một chút */
        }


        .login-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        .login-box h2 {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            transition: 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0px 0px 8px rgba(40, 167, 69, 0.6);
        }

        .btn-login {
            background: #28a745;
            color: white;
            font-weight: bold;
            width: 100%;
            transition: 0.3s ease-in-out;
        }

        .btn-login:hover {
            background: #218838;
        }

        .extra-links {
            text-align: center;
            margin-top: 15px;
        }

        .extra-links a {
            text-decoration: none;
            font-weight: bold;
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
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var icon = document.getElementById("toggleIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

<div class="login-container">
    <div class="login-box">
        <h2>🔐 Đăng Nhập</h2>
        <p>Vui lòng nhập thông tin để tiếp tục</p>

        <?php if(isset($error)) { echo $error; } ?>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" class="form-control" name="email" placeholder="Nhập email..." required>
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-lock"></i> Mật khẩu:</label>
                <div class="input-group">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Nhập mật khẩu..." required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword()">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>


            <button type="submit" name="dangnhap" class="btn btn-login"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
        </form>

        <div class="extra-links">
            <p><a href="chitiet.php?quanly=quenmatkhau" style="color: red;"><i class="fas fa-key"></i> Quên mật khẩu?</a></p>
            <p><a href="chitiet.php?quanly=dangky"><i class="fas fa-user-plus"></i> Đăng ký tài khoản mới</a></p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
