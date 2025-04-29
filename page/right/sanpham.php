<?php
include("admin/config/config.php");

$id_sanpham = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
                WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                AND tbl_sanpham.id_sanpham = '$id_sanpham' 
                LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);
$row_chitiet = mysqli_fetch_array($query_chitiet);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row_chitiet['tensanpham']; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="admin/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh']; ?>" class="img-fluid rounded" alt="<?php echo $row_chitiet['tensanpham']; ?>">
        </div>
        <div class="col-md-6">
            <h2 class="font-weight-bold fs-3"> <?php echo $row_chitiet['tensanpham']; ?> </h2>
            <p class='fs-4'><strong>Mã SP:</strong> <?php echo $row_chitiet['masp']; ?></p>
            <p class='fs-4'><strong>Số lượng còn lại:</strong> <?php echo $row_chitiet['soluong']; ?></p>
            <p class='fs-4'><strong>Size:</strong> <?php echo $row_chitiet['size']; ?></p>
            <p class="text-danger font-weight-bold fs-3 fs-3">
                <?php echo number_format($row_chitiet['giasp']) . '₫'; ?>
                <span class="text-muted text-decoration-line-through fs-4"><?php echo number_format($row_chitiet['giamgia']) . '₫'; ?></span>
            </p>
            <form method="POST" action="page/right/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham']; ?>">
                <button type="submit" name="themgiohang" class="btn btn-success btn-lg">Thêm vào giỏ hàng <i class="fa fa-shopping-cart"></i></button>
            </form>
        </div>
    </div>
    <div class="mt-4 p-3 bg-white rounded shadow-sm">
        <h3 class='fs-3'>Chi tiết sản phẩm</h3>
        <p class='fs-4'><?php echo $row_chitiet['noidung']; ?></p>
    </div>
    <h3 class="mt-5 text-center">Sản phẩm liên quan</h3>
    <div class="row">
        <?php
        $sql_pro = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = '{$row_chitiet['id_danhmuc']}' AND id_sanpham != '$id_sanpham' ORDER BY RAND() LIMIT 4";
        $query_pro = mysqli_query($mysqli, $sql_pro);
        while ($row = mysqli_fetch_array($query_pro)) {
        ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card shadow-sm">
                    <a href="chitiet.php?quanly=sanpham&id=<?php echo $row['id_sanpham']; ?>">
                        <img src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" class="card-img-top" alt="<?php echo $row['tensanpham']; ?>">
                    </a>
                    <div class="card-body text-center">
                        <a href="chitiet.php?quanly=sanpham&id=<?php echo $row['id_sanpham']; ?>" class="text-dark font-weight-bold fs-3 d-block">
                            <?php echo htmlspecialchars($row['tensanpham']); ?>
                        </a>
                        <p class="text-danger font-weight-bold fs-3 fs-3">
                            <?php echo number_format($row['giasp']) . '₫'; ?>
                            <span class="text-muted small text-decoration-line-through"><?php echo number_format($row['giamgia']) . '₫'; ?></span>
                        </p>
                        <div class="d-flex justify-content-center gap-2">
                            <form method="POST" action="page/right/themgiohang.php?idsanpham=<?php echo $row['id_sanpham']; ?>">
                                <button type="submit" name="themgiohang" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                                </button>
                            </form>
                            <a href="chitiet.php?quanly=sanpham&id=<?php echo $row['id_sanpham']; ?>" class="btn btn-outline-dark btn-sm">
                                <i class="fa fa-eye"></i> Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
