<?php
// Kết nối database
$root_path = realpath(dirname(__FILE__) . '/../../config/config.php');
if (file_exists($root_path)) {
    include_once($root_path);
} else {
    die("❌ Không thể tải file cấu hình. Kiểm tra lại đường dẫn: $root_path");
}

// Phân trang
$page = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;
$limit = 10;
$begin = ($page - 1) * $limit;

// Lấy tổng số sản phẩm
$sql_total = "SELECT COUNT(*) AS total FROM tbl_sanpham";
$query_total = mysqli_query($mysqli, $sql_total);
$row_total = mysqli_fetch_assoc($query_total);
$total_products = $row_total['total'];
$total_pages = ceil($total_products / $limit);

// Lấy danh sách sản phẩm
$sql_lietke_sp = "SELECT * FROM tbl_sanpham 
                  INNER JOIN tbl_danhmuc ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                  ORDER BY id_sanpham DESC 
                  LIMIT $begin, $limit";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4"><i class="fas fa-box"></i> Quản Lý Sản Phẩm</h2>

    <!-- Form tìm kiếm -->
    <form class="form-inline mb-3" action="index.php?action=timkiem&query=them" method="POST">
        <input class="form-control mr-sm-2" type="search" placeholder="Tên sản phẩm" name="tukhoa" required>
        <button class="btn btn-outline-success" type="submit" name="timkiem">Tìm kiếm</button>
    </form>

    <!-- Nút thêm sản phẩm (chỉ admin hoặc quản lý) -->
    <?php if ($_SESSION['role_id'] != 3) { ?>
        <a href="index.php?action=quanlysp&query=them" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Thêm Sản Phẩm</a>
    <?php } ?>

    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Giá bán</th>
                <th>Giảm giá</th>
                <?php if ($_SESSION['role_id'] != 3) { ?>
                    <th style="color:red;">Giá nhập</th>
                <?php } ?>
                <th>Số lượng</th>
                <th>Size</th>
                <th>Danh mục</th>
                <th>Hình ảnh</th>
                <th>Mã sản phẩm</th>
                <th>Mô tả</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $begin + 1; while ($row = mysqli_fetch_array($query_lietke_sp)) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row['tensanpham']); ?></td>
                    <td><?php echo number_format($row['giasp'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo number_format($row['giamgia'], 0, ',', '.'); ?> VNĐ</td>
                    <?php if ($_SESSION['role_id'] != 3) { ?>
                        <td><?php echo number_format($row['gianhap'], 0, ',', '.'); ?> VNĐ</td>
                    <?php } ?>
                    <td><?php echo $row['soluong']; ?></td>
                    <td><?php echo $row['size']; ?></td>
                    <td><?php echo $row['tendanhmuc']; ?></td>
                    <td>
                        <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" 
                             style="width:120px;height:120px;object-fit:contain; border:1px solid #ddd;">
                    </td>
                    <td><?php echo htmlspecialchars($row['masp']); ?></td>
                    <td><?php echo substr(htmlspecialchars($row['noidung']), 0, 50) . '...'; ?></td>
                    <td>
                        <?php if ($_SESSION['role_id'] != 3) { ?>
                            <a href="index.php?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <?php if ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2) { ?>
                                <a href="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            <?php } ?>
                        <?php } else { ?>
                            <span class="badge badge-secondary">Chỉ xem</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- PHÂN TRANG -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($page > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=quanlysp&query=lietke&trang=<?php echo $page - 1; ?>" aria-label="Trước">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php } ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="index.php?action=quanlysp&query=lietke&trang=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>

            <?php if ($page < $total_pages) { ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=quanlysp&query=lietke&trang=<?php echo $page + 1; ?>" aria-label="Tiếp">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>
