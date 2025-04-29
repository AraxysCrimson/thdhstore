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

<ul class="navbar-nav px-3">
  <li class="nav-item text-nowrap">
  </li>
</ul>
</nav>
<div class="container-fluid">
  <div class="row">
    <?php
    if ($_SESSION['role_id'] == 1) { // Admin
    ?>
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=quanlydanhmucsanpham&query=them">
              <i class="bi bi-folder"></i>
              Danh Mục Sản Phẩm
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=quanlysp&query=lietke"> 
              <i class="bi bi-minecart"></i>
              Quản lý sản phẩm
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=quanlydonhang&query=lietke">
              <i class="bi bi-question-circle-fill"></i>
              Quản Lý đơn hàng
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=quanlyphanhoi&query=lietke">
              <i class="bi bi-vector-pen fs-2x"></i>
              Quản Lý phản hồi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=quanlythanhvien&query=lietke">
              <i class="bi bi-file-earmark-text"></i>
              Quản Lý thành viên
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=thongke&query=lietke">
              <i class="bi bi-bar-chart-fill"></i>
              Thống kê
            </a>
          </li>
        </ul>
      </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      <?php
    } else if ($_SESSION['role_id'] == 2) { // Quản lý
      ?>
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=quanlydanhmucsanpham&query=them">
                <i class="bi bi-folder"></i>
                Danh Mục Sản Phẩm
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=quanlysp&query=lietke"> <!-- Sửa lại đúng action -->
                <i class="bi bi-minecart"></i>
                Quản lý sản phẩm
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=quanlydonhang&query=lietke">
                <i class="bi bi-question-circle-fill"></i>
                Quản Lý đơn hàng
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=quanlyphanhoi&query=lietke">
                <i class="bi bi-vector-pen fs-2x"></i>
                Quản Lý phản hồi
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=quanlythanhvien&query=lietke">
                <i class="bi bi-file-earmark-text"></i>
                Quản Lý thành viên
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=thongke&query=lietke">
                <i class="bi bi-bar-chart-fill"></i>
                Thống kê
              </a>
            </li>
          </ul>
        </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <?php
    } else { // Nhân viên
      ?>
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=quanlysp&query=lietke"> 
                <i class="bi bi-minecart"></i>
                Quản lý sản phẩm
              </a>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=quanlydonhang&query=lietke">
                <i class="bi bi-question-circle-fill"></i>
                Quản Lý đơn hàng
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=quanlyphanhoi&query=lietke">
                <i class="bi bi-vector-pen fs-2x"></i>
                Quản Lý phản hồi
              </a>
            </li>
          </ul>
        </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <?php } ?>
