<?php
// Kiểm tra session trước khi khởi tạo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra trang hiện tại
$page = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;
$limit = 10;  // Giới hạn số phản hồi trên mỗi trang
$begin = ($page - 1) * $limit;

// Lấy tổng số phản hồi
$sql_total = "SELECT COUNT(*) AS total FROM feedback";
$query_total = mysqli_query($mysqli, $sql_total);
$row_total = mysqli_fetch_assoc($query_total);
$total_feedback = $row_total['total'];
$total_pages = ceil($total_feedback / $limit);

// Truy vấn danh sách phản hồi có phân trang
$sql_lietke_ph = "SELECT * FROM feedback 
                  ORDER BY id_feedback DESC 
                  LIMIT $begin, $limit";
$query_lietke_ph = mysqli_query($mysqli, $sql_lietke_ph);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4"><i class="fa-solid fa-comments"></i> Phản hồi & Liên hệ</h2>
    
    <table class="table table-bordered table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Chủ đề</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Tình trạng</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = $begin + 1;
            while ($row = mysqli_fetch_array($query_lietke_ph)) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row['tennguoidung']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['dienthoai']); ?></td>
                    <td><?php echo htmlspecialchars($row['diachi']); ?></td>
                    <td><?php echo htmlspecialchars($row['chude']); ?></td>
                    <td><?php echo htmlspecialchars($row['noidung']); ?></td>
                    <td><?php echo $row['time_lh']; ?></td>
                    <td>
                        <?php if ($row['status_lh'] == 1) { ?>
                            <a href="modules/quanlyphanhoi/xuly.php?code=<?php echo $row['id_feedback']; ?>" 
                               class="btn btn-warning btn-sm" 
                               onclick="return confirm('Bạn có chắc chắn muốn đánh dấu phản hồi này là đã xem?');">
                                <i class="fas fa-eye-slash"></i> Chưa xem
                            </a>
                        <?php } else { ?>
                            <button class="btn btn-success btn-sm" disabled>
                                <i class="fas fa-check"></i> Đã xem
                            </button>
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
                    <a class="page-link" href="index.php?action=quanlyphanhoi&query=lietke&trang=<?php echo $page - 1; ?>" aria-label="Trước">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php } ?>
            
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="index.php?action=quanlyphanhoi&query=lietke&trang=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>

            <?php if ($page < $total_pages) { ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=quanlyphanhoi&query=lietke&trang=<?php echo $page + 1; ?>" aria-label="Tiếp">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<script>
    function confirmAction(message, url) {
        if (confirm(message)) {
            window.location.href = url;
        }
    }
</script>
