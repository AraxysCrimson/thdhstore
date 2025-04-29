<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("admin/config/config.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .main-container {
            min-height: calc(100vh - 150px);
            padding: 20px;
        }
        .cart-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .jumbotron {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            width: 100%;
            max-width: 1000px;
        }
        .table-responsive {
            width: 100%;
            max-width: 1000px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .btn-custom {
            background: #ff9800;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
        }
        .quantity-controls {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .quantity-controls a {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background: #f8f9fa;
            color: #333;
            text-decoration: none;
            font-size: 16px;
        }
        .quantity-controls span {
            padding: 5px 15px;
            border: 1px solid #ccc;
            background: white;
            font-weight: bold;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-warning {
            background-color: #ff5f00;
            border: none;
            color: white;
        }
        .btn-warning:hover {
            background-color: #e65c00;
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="cart-content">
        <div class="jumbotron">
            <h1>
                <i class="fa fa-shopping-cart"></i> Giỏ Hàng Của Bạn
            </h1>
        </div>

        <div class="table-responsive">
        <?php if(isset($_SESSION['dangky'])) { ?>
        <form method="POST" action="page/right/thanhtoan.php">
            <?php $tongtien = 0; ?>
            <input type="hidden" name="payment_method" value="cod">
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã SP</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Hình Ảnh</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Size</th>
                        <th>Thành Tiền</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($_SESSION['cart'])) {
                    $i = 0;
                    foreach ($_SESSION['cart'] as $cart_item) {
                        $i++;
                        $thanhtien = $cart_item['soluong'] * $cart_item['giamgia'];
                        $tongtien += $thanhtien;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $cart_item['masp']; ?></td>
                        <td><?php echo $cart_item['tensanpham']; ?></td>
                        <td><img src="admin/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>" width="80" style="border-radius: 5px;"></td>
                        <td>
                            <div class="quantity-controls">
                                <a href="page/right/themgiohang.php?tru=<?php echo $cart_item['id']; ?>">-</a>
                                <span><?php echo $cart_item['soluong']; ?></span>
                                <a href="page/right/themgiohang.php?cong=<?php echo $cart_item['id']; ?>">+</a>
                            </div>
                        </td>
                        <td><?php echo number_format($cart_item['giamgia']) . '₫'; ?></td>
                        <td>
                            <select class="form-control" name="size_ids[<?php echo $cart_item['id']; ?>]" required>
                                <option value="">-- Chọn size --</option>
                                <?php
                                $role = "SELECT * FROM `tbl_size`";
                                $sql_role = mysqli_query($mysqli, $role);
                                while ($row = mysqli_fetch_array($sql_role)) {
                                    echo '<option value="' . $row['size_id'] . '">' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td><?php echo number_format($thanhtien) . '₫'; ?></td>
                        <td>
                            <a href="page/right/themgiohang.php?xoa=<?php echo $cart_item['id']; ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Xóa
                            </a>
                            <input type="hidden" name="product_ids[]" value="<?php echo $cart_item['id']; ?>">
                        </td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td colspan="7" class="text-right"><strong>Tổng tiền:</strong></td>
                        <td><strong><?php echo number_format($tongtien) . '₫'; ?></strong></td>
                        <td><a href="page/right/themgiohang.php?xoatatca=1" class="btn btn-warning btn-sm">Xóa Tất Cả</a></td>
                    </tr>
                <?php } else {
                    echo "<tr><td colspan='9'><p class='text-center text-danger'>🚫 Giỏ hàng trống!</p></td></tr>";
                } ?>
                </tbody>
            </table>
            <input type="hidden" name="tongtien" value="<?php echo $tongtien; ?>">
            <div class="text-center mb-4">
                <button type="submit" name="thanhtoan" class="btn btn-success btn-lg">
                    <i class="fa fa-money"></i> Thanh toán tiền mặt
                </button>
            </div>
        </form>
        <!-- Form MoMo riêng -->
        <form method="POST" action="page/right/thanhtoan.php" style="text-align: center;">
            <input type="hidden" name="payment_method" value="momo">
            <input type="hidden" name="tongtien" value="<?php echo $tongtien; ?>">
            <button type="submit" name="thanhtoan" class="btn btn-warning btn-lg" style="border-radius: 20px;">
                <i class="fa fa-qrcode"></i> Thanh toán MoMo
            </button>
        </form>
        <?php } else { ?>
        <div class="text-center mt-4">
                <a href="chitiet.php?quanly=dangnhap" class="btn btn-info btn-lg">
                    <i class="fa fa-user"></i> Đăng nhập để mua hàng
                </a>
            </div>
        <?php } ?>
        <!-- Lịch sử đơn hàng -->
        <?php
        if (isset($_SESSION['dangky'])) {
            $id_khachhang = $_SESSION['id_khachhang'];
            $sql_lh = "SELECT * FROM tbl_cart WHERE id_khachhang = '$id_khachhang' ORDER BY id_cart DESC";
            $query_lh = mysqli_query($mysqli, $sql_lh);
        ?>
        <div class="table-responsive mt-5">
            <h4 class="text-center mb-3">📦 Lịch Sử Mua Hàng</h4>
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã Đơn</th>
                        <th>Ngày Đặt</th>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Mã SP</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                while ($row_cart = mysqli_fetch_array($query_lh)) {
                    $code_cart = $row_cart['code_cart'];
                    $sql_sp = "SELECT cd.*, sp.tensanpham, sp.hinhanh, sp.masp, sp.giamgia, sz.name
                                FROM tbl_cart_details cd
                                JOIN tbl_sanpham sp ON cd.id_sanpham = sp.id_sanpham
                                JOIN tbl_size sz ON cd.size_id = sz.size_id
                                WHERE cd.code_cart = '$code_cart'";
                    $query_sp = mysqli_query($mysqli, $sql_sp);
                    while ($row = mysqli_fetch_array($query_sp)) {
                        $i++;
                        $thanhtien = $row['soluongmua'] * $row['giamgia'];
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $code_cart; ?></td>
                        <td><?php echo $row_cart['updata_time']; ?></td>
                        <td><?php echo $row['tensanpham']; ?></td>
                        <td><img src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" width="80"></td>
                        <td><?php echo $row['masp']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['soluongmua']; ?></td>
                        <td><?php echo number_format($row['giamgia'], 0, ',', '.'); ?>₫</td>
                        <td><?php echo number_format($thanhtien, 0, ',', '.'); ?>₫</td>
                    </tr>
                <?php }} ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
