<?php
include("admin/config/config.php");

// Xử lý số trang
$page = isset($_GET['trang']) ? max(1, intval($_GET['trang'])) : 1;
$limit = 8;
$begin = ($page - 1) * $limit;

// Kiểm tra xem có biến GET nào không
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Kiểm tra xem ID có phải là bài viết không
    if ($id == 9) {
        $sql_bv = "SELECT * FROM tbl_baiviet WHERE id = '$id' LIMIT 1";
        $query_bv = mysqli_query($mysqli, $sql_bv);

        if (mysqli_num_rows($query_bv) > 0) {
            $row_bv = mysqli_fetch_array($query_bv);
            ?>
            <h2 class="section-title text-center"><?php echo $row_bv['tenbaiviet']; ?></h2>
            <p class="text-center"><?php echo $row_bv['tomtat']; ?></p>
            <div class="container"> <?php echo $row_bv['noidung']; ?> </div>
            <?php
        } else {
            echo "<p class='text-danger text-center'>Không tìm thấy bài viết!</p>";
        }
    } else {
        // Nếu không phải bài viết, hiển thị danh mục sản phẩm
        $sql_pro = "SELECT * FROM tbl_sanpham WHERE id_danhmuc='$id' ORDER BY id_sanpham DESC LIMIT $begin, $limit";
        $query_pro = mysqli_query($mysqli, $sql_pro);

        // Lấy tên danh mục
        $sql_cate = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$id' LIMIT 1";
        $query_cate = mysqli_query($mysqli, $sql_cate);
        $row_title = mysqli_fetch_array($query_cate);
        ?>

        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $row_title['tendanhmuc']; ?></title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>
        <body>
        <div class="container">
            <h2 class="section-title text-center">🛍️ <?php echo $row_title['tendanhmuc']; ?> 🛍️</h2>
            <div class="row">
                <?php while ($row_pro = mysqli_fetch_array($query_pro)) { ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm">
                            <a href="chitiet.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham']; ?>">
                                <img src="admin/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row_pro['tensanpham']); ?>">
                            </a>
                            <div class="card-body text-center">
                                <a href="chitiet.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham']; ?>" class="text-dark font-weight-bold d-block">
                                    <?php echo htmlspecialchars($row_pro['tensanpham']); ?>
                                </a>
                                <p class="text-danger font-weight-bold">
                                    <?php echo number_format($row_pro['giasp']) . '₫'; ?>
                                    <span class="text-muted small text-decoration-line-through"><?php echo number_format($row_pro['giamgia']) . '₫'; ?></span>
                                </p>
                                <div class="d-flex justify-content-center gap-2">
                                    <form method="POST" action="page/right/themgiohang.php?idsanpham=<?php echo $row_pro['id_sanpham']; ?>">
                                        <button type="submit" name="themgiohang" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                                        </button>
                                    </form>
                                    <a href="chitiet.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham']; ?>" class="btn btn-outline-dark btn-sm">
                                        <i class="fa fa-eye"></i> Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Phân trang -->
            <?php
            $sql_count = "SELECT COUNT(*) as total FROM tbl_sanpham WHERE id_danhmuc='$id'";
            $query_count = mysqli_query($mysqli, $sql_count);
            $row_count = mysqli_fetch_array($query_count);
            $total_pages = ceil($row_count['total'] / $limit);
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?id=<?php echo $id; ?>&trang=<?php echo ($page - 1); ?>" aria-label="Previous">&laquo;</a>
                        </li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?id=<?php echo $id; ?>&trang=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($page < $total_pages) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?id=<?php echo $id; ?>&trang=<?php echo ($page + 1); ?>" aria-label="Next">&raquo;</a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
} else {
    echo "<p class='text-danger text-center'>Không có ID danh mục hoặc bài viết được cung cấp!</p>";
}
?>