<div id="mains">
    <?php
    $tam = isset($_GET['quanly']) ? $_GET['quanly'] : '';

    if ($tam != 'camon') {
        include('left/danhmuc.php');
    }
    ?>

    <div class="sidebar_right" style="<?php echo ($tam == 'camon') ? 'width: 100%; display: flex; justify-content: center;' : ''; ?>">
        <?php
        switch ($tam) {
            case 'danhmucsanpham':
                include("page/right/danhmucsanpham.php");
                break;
            case 'danhmucsp':
                include("page/right/index.php");
                break;
            case 'ao':
                include("page/right/ao.php");
                break;
            case 'quan':
                include("page/right/quan.php");
                break;
            case 'phukien':
                include("page/right/phukien.php");
                break;
            case 'giohang':
                include("page/right/giohang.php");
                break;
            case 'thanhtoan':
                include("page/right/thanhtoan.php");
                break;
            case 'lienhe':
                include("page/right/lienhe.php");
                break;
            case 'dangky':
                include("page/right/dangky.php");
                break;
            case 'camon':
                include("page/right/camon.php");
                break;
            case 'timkiem':
                include("page/right/timkiem.php");
                break;
            case 'quenmatkhau':                           
                include("page/right/quenmatkhau.php");     
                break;
            default:
                include("right/index.php");
                break;
        }
        ?>
    </div>
    <div class="clear"></div>
</div>
