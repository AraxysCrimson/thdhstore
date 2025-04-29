<?php
include("admin/config/config.php");

// Xử lý số trang
$page = isset($_GET['trang']) ? max(1, intval($_GET['trang'])) : 1;
$limit = 8;
$begin = ($page - 1) * $limit;

// Gộp danh mục Áo (Áo khoác - 44, Áo hoodie & áo len - 45, Áo thun - 46)
$id_danhmuc_list = [44, 45, 46];

// 👉 **Khởi tạo biến danh mục rỗng để tránh lỗi**
$danhmuc_names = [];

// Lấy tên danh mục
$sql_tendanhmuc = "SELECT tendanhmuc FROM tbl_danhmuc WHERE id_danhmuc IN (" . implode(',', $id_danhmuc_list) . ")";
$query_danhmuc = mysqli_query($mysqli, $sql_tendanhmuc);
while ($row = mysqli_fetch_array($query_danhmuc)) {
    $danhmuc_names[] = $row['tendanhmuc'];
}

// Truy vấn sản phẩm trong danh mục Áo
$sql_pro = "SELECT * FROM tbl_sanpham WHERE id_danhmuc IN (" . implode(',', $id_danhmuc_list) . ") ORDER BY id_sanpham DESC LIMIT $begin, $limit";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục Áo</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome 4.7.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Giao diện chung */
        html, body {
            height: 100%;
            background-color: #f8f9fa;
        }

        /* Căn giữa nội dung chính */
        .content {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        /* Tiêu đề */
        .section-title {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Card sản phẩm */
        .product-card {
            background: #ffffff;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
            height: 100%;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-img {
            width: 100%;
            border-radius: 10px;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #ff5722;
            text-align: center;
        }

        .old-price {
            font-size: 0.9rem;
            color: #999;
            text-decoration: line-through;
        }

        .product-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .pagination {
            margin-top: 20px;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="content">
    <!-- Tiêu đề -->
    <h2 class="section-title">👕 DANH MỤC ÁO 👕</h2>

    <!-- Danh sách sản phẩm -->
    <div class="row">
        <?php 
        if (mysqli_num_rows($query_pro) == 0) {
            echo "<div class='col-12'><div class='alert alert-warning text-center'>⚠️ Hiện chưa có sản phẩm nào trong danh mục Áo!</div></div>";
        } else {
            while ($row = mysqli_fetch_array($query_pro)) { 
        ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="product-card">
                    <a href="chitiet.php?quanly=sanpham&id=<?php echo $row['id_sanpham']; ?>">
                        <img src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" class="product-img">
                    </a>
                    <div class="text-center">
                        <a href="chitiet.php?quanly=sanpham&id=<?php echo $row['id_sanpham']; ?>" class="product-title">
                            <?php echo htmlspecialchars($row['tensanpham']); ?>
                        </a>
                        <p class="product-price">
                            <?php echo number_format($row['giasp']) . '₫'; ?>
                            <span class="old-price"><?php echo number_format($row['giamgia']) . '₫'; ?></span>
                        </p>
                        <div class="product-actions">
                            <form method="POST" action="page/right/themgiohang.php?idsanpham=<?php echo $row['id_sanpham']; ?>">
                                <button type="submit" name="themgiohangs" class="btn btn-outline-primary btn-sm">
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
        <?php } } ?>
    </div>

    <!-- Phân trang -->
    <?php
    $sql_count = "SELECT COUNT(*) as total FROM tbl_sanpham WHERE id_danhmuc IN (" . implode(',', $id_danhmuc_list) . ")";
    $query_count = mysqli_query($mysqli, $sql_count);
    $row_count = mysqli_fetch_array($query_count);
    $total_pages = ceil($row_count['total'] / $limit);
    ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($page > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="?quanly=ao&trang=<?php echo ($page - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php } ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?quanly=ao&trang=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>

            <?php if ($page < $total_pages) { ?>
                <li class="page-item">
                    <a class="page-link" href="?quanly=ao&trang=<?php echo ($page + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
