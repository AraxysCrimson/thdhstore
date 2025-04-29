<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn quý khách</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Font Awesome 4.7.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .jumbotron {
            background: linear-gradient(135deg, #006eff, #7300ff);
            color: white;
            padding: 70px;
            border-radius: 20px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            max-width: 900px;
            width: 100%;
            text-align: center;
        }

        .jumbotron h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .jumbotron .lead {
            font-size: 1.2rem;
        }

        .jumbotron a {
            color: #ffeb3b;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .jumbotron a:hover {
            color: #ffcc00;
            text-decoration: underline;
        }

        .btn-custom {
            background: #ff9800;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
            transition: background 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background: #ff5722;
            color: white;
        }
    </style>
</head>
<body>

<!-- Nội dung giữa trang -->
<div class="main-wrapper">
    <div class="jumbotron">
        <h1 class="display-3">
            <i class="fa fa-smile-o"></i> CẢM ƠN QUÝ KHÁCH! <i class="fa fa-smile-o"></i>
        </h1>
        <p class="lead">
            Vui lòng kiểm tra <strong>Email</strong> để nhận thông tin từ <b>THDH Store</b>.
        </p>
        <hr>
        <p>
            Liên hệ với chúng tôi? 
            <a href="http://localhost/thoitrangnam/chitiet.php?quanly=lienhe">
                <i class="fa fa-envelope-o"></i> Liên hệ ngay
            </a>
        </p>
        <p class="lead">
            <a class="btn btn-custom" href="http://localhost/thoitrangnam/indexs.php">
                <i class="fa fa-shopping-cart"></i> Tiếp tục mua hàng
            </a>
        </p>
    </div>
</div>

<!-- Footer sẽ hiển thị bình thường nếu có -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
