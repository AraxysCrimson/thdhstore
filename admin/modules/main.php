<div class="clear"></div>
<div class="main">
    <?php
    // Kiểm tra nếu `action` và `query` tồn tại, nếu không đặt giá trị mặc định
    $tam = isset($_GET['action']) ? $_GET['action'] : '';
    $query = isset($_GET['query']) ? $_GET['query'] : '';

    // 🟢 Quản lý danh mục sản phẩm 
    if ($tam == 'quanlydanhmucsanpham') {
        if ($query == 'sua') {
            include("modules/quanlydanhmucsp/sua.php");
        } else {
            include("modules/quanlydanhmucsp/lietke.php"); 
        }

    // 🟠 Quản lý sản phẩm
    } elseif ($tam == 'quanlysp') {
        if ($query == 'sua') {
            include("modules/quanlysp/sua.php");
        } elseif ($query == 'them') {
            include("modules/quanlysp/them.php");
        } else {  
            include("modules/quanlysp/lietke.php"); 
        }

    // 🔵 Quản lý đơn hàng
    } elseif ($tam == 'quanlydonhang' && $query == 'lietke') {
        include("modules/quanlydonhang/lietke.php");

    // 🟡 Xem đơn hàng (MỚI BỔ SUNG)
    } elseif ($tam == 'donhang' && $query == 'xemdonhang') {
        include("modules/quanlydonhang/xemdonhang.php");

    // 🟣 Quản lý phản hồi
    } elseif ($tam == 'quanlyphanhoi' && $query == 'lietke') {
        include("modules/quanlyphanhoi/lietke.php");

    // 🟡 Xem đơn hàng
    } elseif ($tam == 'donhang' && $query == 'xemdonhang') {
        include("modules/quanlydonhang/xemdonhang.php");

    // 🔴 Quản lý danh mục bài viết
    } elseif ($tam == 'quanlydanhmucbaiviet') {
        if ($query == 'sua') {
            include("modules/quanlydanhmucbaiviet/sua.php");
        } else {
            include("modules/quanlydanhmucbaiviet/lietke.php");
        }

    // 🟤 Quản lý bài viết
    } elseif ($tam == 'quanlybaiviet') {
        if ($query == 'sua') {
            include("modules/quanlybaiviet/sua.php");
        } else {
            include("modules/quanlybaiviet/lietke.php");
        }

    // 🔍 Chức năng tìm kiếm
    } elseif ($tam == 'timkiem' && $query == 'them') {
        include("modules/quanlysp/timkiem.php");
    } elseif ($tam == 'timkiemmadh' && $query == 'them') {
        include("modules/quanlydonhang/timkiem.php");
    } elseif ($tam == 'timkiembv' && $query == 'them') {
        include("modules/quanlybaiviet/timkiem.php");

    // 👥 Quản lý thành viên
    } elseif ($tam == 'quanlythanhvien') {
        if ($query == 'lietke') {
            include("modules/quanlythanhvien/lietke.php");
        } elseif ($query == 'sua') {
            include("modules/quanlythanhvien/sua.php");
        } elseif ($query == 'them') {
            include("modules/quanlythanhvien/them.php");
        }

    // 🎥 Quản lý Slide
    } elseif ($tam == 'quanlyslide') {
        if ($query == 'sua') {
            include("modules/quanlyslide/sua.php");
        }

    // 📊 Thống kê
    } elseif ($tam == 'thongke' && $query == 'lietke') {
        include("modules/thongke.php");

    // 🛑 Nếu không có `action` hợp lệ, hiển thị thông báo
    } else {
        echo "<h4 class='text-center mt-3 text-danger'>⚠️ Vui lòng chọn chức năng quản lý!</h4>";
    }
    ?>
</div>
