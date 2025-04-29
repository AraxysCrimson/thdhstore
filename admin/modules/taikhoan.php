<div class="container text-center mt-5">
    <h2 class="text-primary font-weight-bold">
        <i class="fas fa-store"></i> Chào mừng bạn đến với <span class="text-danger">THDH Store</span>
    </h2>
    <h5 class="text-secondary mt-3">
        Chúc bạn có một ngày làm việc hiệu quả! 🚀
    </h5>

    <div class="mt-4">
        <?php if ($_SESSION['role_id'] == 1) { ?>
            <h4 class="text-danger font-weight-bold">
                <i class="fas fa-user-shield"></i> Hello: ADMIN
            </h4>
        <?php } elseif ($_SESSION['role_id'] == 2) { ?>
            <h4 class="text-warning font-weight-bold">
                <i class="fas fa-user-tie"></i> Hello: Quản Lý
            </h4>
        <?php } else { ?>
            <h4 class="text-success font-weight-bold">
                <i class="fas fa-user"></i> Hello: Nhân viên
            </h4>
        <?php } ?>
    </div>

    <h5 class="mt-3 text-danger">
        <?php if (isset($_SESSION['dangnhap'])) { echo "👋 " . $_SESSION['dangnhap']; } ?>
    </h5>
</div>
