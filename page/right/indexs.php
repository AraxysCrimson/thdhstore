<?php
include("admin/config/config.php");

$sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 21";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hàng Mới Về</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-primary">HÀNG MỚI VỀ</h2>
    <div class="text-center mb-3">
        <a class="text-decoration-none text-info" href="indexs.php?quanly=danhmucsp&id=1">Xem thêm >></a>
    </div>
    <div class="row">
        <?php while ($row = mysqli_fetch_array($query_pro)) { ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm">
                    <a href="chitiet.php?quanly=sanpham&id=<?php echo $row['id_sanpham']; ?>">
                        <img src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" class="card-img-top" alt="<?php echo $row['tensanpham']; ?>">
                    </a>
                    <div class="card-body text-center">
                        <a href="chitiet.php?quanly=sanpham&id=<?php echo $row['id_sanpham']; ?>" class="text-dark font-weight-bold d-block">
                            <?php echo htmlspecialchars($row['tensanpham']); ?>
                        </a>
                        <p class="text-danger font-weight-bold">
                            <?php echo number_format($row['giamgia']) . '₫'; ?>
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
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
