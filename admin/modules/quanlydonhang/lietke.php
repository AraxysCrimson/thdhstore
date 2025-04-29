<?php
// Xác định đường dẫn phân trang
$base_url = "index.php?action=quanlydonhang&query=lietke&trang=";

// PHÂN TRANG
$page = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;
$limit = 10; // Số đơn hàng hiển thị trên mỗi trang
$begin = ($page - 1) * $limit;

// Lấy tổng số đơn hàng
$sql_total = "SELECT COUNT(*) AS total FROM tbl_cart";
$query_total = mysqli_query($mysqli, $sql_total);
$row_total = mysqli_fetch_assoc($query_total);
$total_orders = $row_total['total'];
$total_pages = ceil($total_orders / $limit); // Tổng số trang cần thiết

// Lấy danh sách đơn hàng
$sql_lietke_dh = "SELECT * FROM tbl_cart 
                  INNER JOIN tbl_dangky ON tbl_cart.id_khachhang = tbl_dangky.id_dangky 
                  ORDER BY tbl_cart.id_cart DESC 
                  LIMIT $begin, $limit";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> Quản lý đơn hàng</h2>
    
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>Thời gian</th>
                <th>Tình trạng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $begin + 1; while ($row = mysqli_fetch_array($query_lietke_dh)) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row['code_cart']); ?></td>
                    <td><?php echo htmlspecialchars($row['tenkhachhang']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo $row['updata_time']; ?></td>
                    <td>
                        <?php if ($row['cart_status'] == 1) { ?>
                            <span class="badge badge-warning">Đơn hàng mới</span>
                            <a href="modules/quanlydonhang/xuly.php?action=xacnhan&code=<?php echo $row['code_cart']; ?>" 
                               class="btn btn-success btn-sm mt-1">
                                <i class="fas fa-check"></i> Xác nhận
                            </a>
                        <?php } else { ?>
                            <span class="badge badge-success">Đã xác nhận</span>
                        <?php } ?>
                    </td>
                    <td>
                    <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart']; ?>" 
                            class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Xem
                        </a>

                        <?php if ($_SESSION['role_id'] != 3) { ?>
                            <a href="modules/quanlydonhang/xuly.php?action=huydon&code=<?php echo $row['code_cart']; ?>" 
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        <?php } else { ?>
                            <span class="badge badge-secondary">Không thể hủy</span>
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
                    <a class="page-link" href="<?php echo $base_url . ($page - 1); ?>" aria-label="Trước">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php } ?>
            
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo $base_url . $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>

            <?php if ($page < $total_pages) { ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $base_url . ($page + 1); ?>" aria-label="Tiếp">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>
