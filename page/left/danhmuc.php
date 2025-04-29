<?php
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>

<!-- Latest Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

<!-- jQuery & Bootstrap JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Sidebar Danh Mục -->
<div class="sidebar_left">
    <h2 class="sidebar-title"><i class="bi bi-list"></i> Danh mục sản phẩm</h2>
    <ul class="list-group">
        <?php while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) { ?>
            <li class="list-group-item">
                <a href="indexs.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc']; ?>">
                    <i class="bi bi-folder"></i> <?php echo htmlspecialchars($row_danhmuc['tendanhmuc']); ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>

<!-- CSS Tùy Chỉnh -->
<style>
    /* Sidebar */
    .sidebar_left {
        background: #ffffff; /* Nền trắng */
        color: #333; /* Màu chữ tối để dễ đọc */
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd; /* Viền nhẹ */
    }

    .sidebar-title {
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    /* Danh sách danh mục */
    .list-group {
        padding: 0;
        background: transparent;
    }

    .list-group-item {
        background: transparent;
        border: none;
        padding: 10px 15px;
        transition: 0.3s;
    }

    .list-group-item a {
        color: #333; /* Đổi màu chữ thành tối hơn */
        text-decoration: none;
        display: block;
        font-size: 1rem;
    }

    /* Hiệu ứng hover */
    .list-group-item:hover {
        background: #f8f9fa; /* Màu nền khi hover */
        border-radius: 5px;
    }

    .list-group-item a i {
        margin-right: 10px;
    }
</style>
