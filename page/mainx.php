<div id="mainx">
    <div class="sidebar-right">
        <?php
        if (isset($_GET['quanly'])) {
            $tam = $_GET['quanly'];
        } else {
            $tam = '';
        }

        switch ($tam) {
            case 'danhmucsanpham':
                include("page/left/danhmuc.php");
                break;
            case 'sanpham':
                include("right/sanpham.php");
                break;
            case 'dangky':
                include("page/right/dangky.php");
                break;
            case 'dangnhap':
                include("page/right/dangnhap.php");
                break;
            case 'giohang':
                include("page/right/giohang.php");
                break;
            case 'thanhtoan':
                include("page/right/thanhtoan.php");
                break;
            case 'camon':
                include("page/right/camon.php");
                break;
            case 'tintuc':
                include("page/left/danhmucbaiviet.php");
                include("page/right/tintuc.php");
                break;
            case 'lienhe':
                include("page/right/lienhe.php");
                break;
            case 'taikhoan':
                include("page/right/taikhoan.php");
                break;
            case 'quenmatkhau':                          
                include("page/right/quenmatkhau.php");    
                break;
            default:
                include("right/danhmucsanpham.php");
                break;
        }
        ?>
        <div class="clear"></div>
    </div>
</div>
