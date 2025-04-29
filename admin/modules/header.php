<?php
// Kiểm tra xem session đã bắt đầu chưa trước khi gọi session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['dangky'])) {
    header('Location:../index.php');
    exit();
}

if ($_SESSION['role_id'] == 4) {
    header("Location:../index.php");
    exit();
}

if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    session_destroy();
    header('Location:../index.php');
    exit();
}
?>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <!-- Logo thương hiệu -->
        <a class="navbar-brand font-weight-bold" href="../index.php">
            <i class="fas fa-store"></i> THDH Store
        </a>

        <!-- Form tìm kiếm -->
        <form class="form-inline ml-auto" action="index.php?action=timkiem&query=them" method="POST">
            <input class="form-control form-control-sm" type="search" placeholder="Tìm kiếm..." 
                   aria-label="Search" name="tukhoa" required>
            <button class="btn btn-outline-success btn-sm ml-2" type="submit" name="timkiem">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <!-- Dropdown tài khoản -->
        <div class="dropdown ml-3">
            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
                <?php if(isset($_SESSION['dangky'])) { echo htmlspecialchars($_SESSION['dangky']); } ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="indexs.php">
                    <i class="bi bi-person-circle"></i> Tài khoản</a></li>
                <li><a class="dropdown-item text-danger" href="index.php?dangxuat=1">
                    <i class="bi bi-box-arrow-right"></i> Đăng xuất</a></li>
            </ul>
        </div>

    </div>
</nav>

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom CSS -->
<style>
    /* Navbar */
    .navbar {
        padding: 10px 20px;
    }

    /* Dropdown */
    .dropdown-menu {
        border-radius: 8px;
        min-width: 150px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dropdown-item {
        transition: background 0.3s ease-in-out;
    }

    .dropdown-item:hover {
        background: #f8f9fa;
    }

    /* Input tìm kiếm */
    .form-inline .form-control {
        width: 200px;
    }

    /* Button tìm kiếm */
    .btn-outline-success {
        border-radius: 5px;
    }
</style>

<!-- jQuery & Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript Fix Dropdown Không Hiển Thị -->
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
