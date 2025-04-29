<?php 
if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
    unset($_SESSION['dangky']);
}
?>
<div class="header">    
    <ul class="list_header">
        <li><a href="chitiet.php?quanly=lienhe">Liên Hệ <i class="fas fa-headset"></i></a></li>
        
        <!-- Facebook -->
        <li>
            <a href="https://www.facebook.com" target="_blank" class="social-icon">
                <i class="fab fa-facebook"></i>
            </a>
        </li> 

        <!-- Instagram -->
        <li>
            <a href="https://www.instagram.com" target="_blank" class="social-icon">
                <i class="fab fa-instagram"></i>
            </a>
        </li>  

        <!-- YouTube -->
        <li>
            <a href="https://www.youtube.com" target="_blank" class="social-icon">
                <i class="fab fa-youtube"></i>
            </a>
        </li>  
    </ul>

    <ul class="user-menu">
        <?php if(isset($_SESSION['dangky'])){ ?>
            <div class="dropdown">
                <button class="dropbtn">
                    <i class="fas fa-user-alt"></i> 
                    <span class="username"><?php echo $_SESSION['dangky']; ?></span>
                </button>
                <div class="dropdown-content">
                    <a href="chitiet.php?quanly=taikhoan"><i class="fas fa-user-circle"></i> Tài khoản</a>
                    <a href="index.php?dangxuat=1"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                </div>
            </div>
        <?php } else { ?>
            <a href="chitiet.php?quanly=dangnhap" class="login-link">
                <i class="fas fa-user-alt"></i> Đăng nhập
            </a>
        <?php } ?>
    </ul>
</div>

<!-- CSS cải thiện giao diện -->
<style>
    /* Header chính */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background: linear-gradient(135deg, #4B2E83, #6A1B9A);
        color: white;
    }

    /* Danh sách menu bên trái */
    .list_header {
        display: flex;
        gap: 15px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .list_header li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s ease-in-out;
    }

    .list_header li a:hover {
        color: #ffcc00;
    }

    /* Hiệu ứng icon mạng xã hội */
    .social-icon i {
        font-size: 18px;
        color: #fff;
        transition: 0.3s ease-in-out;
    }

    .social-icon i:hover {
        transform: scale(1.2);
        color: #ffcc00;
    }

    /* Dropdown tài khoản */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    .dropbtn:hover {
        color: #ffcc00;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        z-index: 100;
        text-align: left;
    }

    .dropdown-content a {
        color: #333;
        padding: 10px;
        display: block;
        text-decoration: none;
        transition: 0.3s ease-in-out;
    }

    .dropdown-content a:hover {
        background-color: #f8f9fa;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Hiệu ứng đăng nhập */
    .login-link {
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: 0.3s ease-in-out;
    }

    .login-link:hover {
        color: #ffcc00;
    }

    /* Căn chỉnh khoảng cách */
    .user-menu {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
    }
</style>
