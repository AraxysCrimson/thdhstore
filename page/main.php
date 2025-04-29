<div id="main">
    <div class="maincontent"> 
        <?php
        if (isset($_GET['quanly'])) {
            $tam = $_GET['quanly'];
        } else {
            $tam = '';
        }

        switch ($tam) {
            case 'danhmucsanpham':
                include("right/danhmuc.php");
                break;
            case 'giohang':
                include("page/right/giohang.php"); 
                break;  
            case 'phukien':
                include("page/right/phukien.php"); 
                break;
            case 'tintuc':
                include("right/tintuc.php");
                break;
            default: 
                include("right/indexs.php");
                break;
        }
        ?>
        <div class="clear"></div>
    </div>
</div>
