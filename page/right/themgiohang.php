<?php
session_start();
include('../../admin/config/config.php');

// Nếu chưa có session giỏ hàng thì khởi tạo
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Hàm cập nhật session giỏ hàng
function update_cart_session($product) {
    $_SESSION['cart'] = $product;
}

// Lấy user_id nếu đăng nhập
$user_id = $_SESSION['user_id'] ?? null;

// ✅ Thêm sản phẩm vào giỏ
if (isset($_POST['themgiohang']) || isset($_POST['muangay']) || isset($_POST['themgiohangs'])) {
    $id = $_GET['idsanpham'];
    $soluong = 1;

    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);

    if (!$row || $row['soluong'] <= 0) {
        echo "<script>alert('Sản phẩm đã hết hàng.'); window.history.back();</script>";
        exit();
    }

    $new_product = [
        'tensanpham' => $row['tensanpham'],
        'id' => $id,
        'soluong' => $soluong,
        'giamgia' => $row['giamgia'],
        'hinhanh' => $row['hinhanh'],
        'masp' => $row['masp']
    ];

    $found = false;
    $product = [];

    // Nếu giỏ hàng đã có, kiểm tra trùng
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cart_item) {
            if ($cart_item['id'] == $id) {
                $cart_item['soluong'] += 1;
                $found = true;
            }
            $product[] = $cart_item;
        }
    }

    // Nếu chưa có sản phẩm thì thêm mới
    if (!$found) {
        $product[] = $new_product;
    }

    update_cart_session($product);

    // Nếu đã đăng nhập → Lưu vào database
    if ($user_id) {
        foreach ($product as $item) {
            $item_id = $item['id'];
            $item_soluong = $item['soluong'];

            // Kiểm tra đã có trong DB chưa
            $check = mysqli_query($mysqli, "SELECT * FROM tbl_giohang WHERE user_id='$user_id' AND id_sanpham='$item_id'");
            if (mysqli_num_rows($check) > 0) {
                mysqli_query($mysqli, "UPDATE tbl_giohang SET soluong='$item_soluong' WHERE user_id='$user_id' AND id_sanpham='$item_id'");
            } else {
                mysqli_query($mysqli, "INSERT INTO tbl_giohang(user_id, id_sanpham, soluong) VALUES ('$user_id', '$item_id', '$item_soluong')");
            }
        }
    }

    header("Location: ../../chitiet.php?quanly=giohang");
    exit();
}

// ✅ Cộng số lượng
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id) {
            $cart_item['soluong'] += 1;
        }
    }
    update_cart_session($_SESSION['cart']);

    if ($user_id) {
        mysqli_query($mysqli, "UPDATE tbl_giohang SET soluong = soluong + 1 WHERE user_id='$user_id' AND id_sanpham='$id'");
    }

    header("Location: ../../chitiet.php?quanly=giohang");
    exit();
}

// ✅ Trừ số lượng
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id && $cart_item['soluong'] > 1) {
            $cart_item['soluong'] -= 1;
        }
    }
    update_cart_session($_SESSION['cart']);

    if ($user_id) {
        mysqli_query($mysqli, "UPDATE tbl_giohang SET soluong = GREATEST(soluong - 1, 1) WHERE user_id='$user_id' AND id_sanpham='$id'");
    }

    header("Location: ../../chitiet.php?quanly=giohang");
    exit();
}

// ✅ Xoá sản phẩm khỏi giỏ
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($id) {
        return $item['id'] != $id;
    });

    if ($user_id) {
        mysqli_query($mysqli, "DELETE FROM tbl_giohang WHERE user_id='$user_id' AND id_sanpham='$id'");
    }

    header("Location: ../../chitiet.php?quanly=giohang");
    exit();
}

// ✅ Xoá toàn bộ giỏ hàng
if (isset($_GET['xoatatca'])) {
    unset($_SESSION['cart']);

    if ($user_id) {
        mysqli_query($mysqli, "DELETE FROM tbl_giohang WHERE user_id='$user_id'");
    }

    header("Location: ../../chitiet.php?quanly=giohang");
    exit();
}

// ✅ Thanh toán
if (isset($_POST['thanhtoan'])) {
    if (!empty($_SESSION['cart'])) {
        header("Location: ../../page/right/camon.php");
        exit();
    } else {
        echo "<script>alert('Giỏ hàng trống!'); window.history.back();</script>";
    }
}
?>
