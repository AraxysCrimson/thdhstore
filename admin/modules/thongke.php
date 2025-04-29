<div class="d-flex justify-content-center align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-center">
        <i class="fas fa-chart-line"></i> Thống kê doanh thu
    </h1>
</div>

<!-- Thống kê tổng quan -->
<div class="row">
    <!-- Tổng doanh thu -->
    <div class="col-md-4">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body text-center">
                <i class="fas fa-dollar-sign fa-3x mb-3"></i>
                <h5 class="card-title">Tổng doanh thu</h5>
                <?php
                $sql_revenue = "SELECT SUM(s.giasp * cd.soluongmua) as total 
                                FROM tbl_cart c
                                JOIN tbl_cart_details cd ON c.code_cart = cd.code_cart 
                                JOIN tbl_sanpham s ON cd.id_sanpham = s.id_sanpham
                                WHERE c.cart_status IN (0, 1)"; // Bao gồm cả đơn hàng đã xác nhận

                $query_revenue = mysqli_query($mysqli, $sql_revenue);
                $row_revenue = mysqli_fetch_array($query_revenue);
                $total_revenue = number_format($row_revenue['total'], 0, ',', '.');
                ?>
                <h3 class="card-text"><?php echo $total_revenue; ?> VNĐ</h3>
            </div>
        </div>
    </div>

    <!-- Tổng đơn hàng -->
    <div class="col-md-4">
        <div class="card stat-card bg-success text-white">
            <div class="card-body text-center">
                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                <h5 class="card-title">Tổng đơn hàng</h5>
                <?php
                    $sql_orders = "SELECT COUNT(DISTINCT code_cart) as total 
                                  FROM tbl_cart 
                                  WHERE cart_status IN (0,1)";
                    $query_orders = mysqli_query($mysqli, $sql_orders);
                    $row_orders = mysqli_fetch_array($query_orders);
                ?>
                <h3 class="card-text"><?php echo $row_orders['total']; ?></h3>
            </div>
        </div>
    </div>

    <!-- Tổng sản phẩm đã bán -->
    <div class="col-md-4">
        <div class="card stat-card bg-info text-white">
            <div class="card-body text-center">
                <i class="fas fa-box-open fa-3x mb-3"></i>
                <h5 class="card-title">Sản phẩm đã bán</h5>
                <?php
                    $sql_sold = "SELECT SUM(cd.soluongmua) as total 
                                FROM tbl_cart c
                                JOIN tbl_cart_details cd ON c.code_cart = cd.code_cart
                                WHERE c.cart_status IN (0,1)";
                    $query_sold = mysqli_query($mysqli, $sql_sold);
                    $row_sold = mysqli_fetch_array($query_sold);
                ?>
                <h3 class="card-text"><?php echo $row_sold['total']; ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Biểu đồ doanh thu -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-chart-bar"></i> Biểu đồ doanh thu theo tháng</h5>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Bảng thống kê sản phẩm -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-fire"></i> Top sản phẩm bán chạy</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng đã bán</th>
                                <th>Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_products = "SELECT p.tensanpham,
                                    SUM(cd.soluongmua) as total_sold,
                                    SUM(p.giasp * cd.soluongmua) as total_revenue
                                    FROM tbl_cart c
                                    JOIN tbl_cart_details cd ON c.code_cart = cd.code_cart
                                    JOIN tbl_sanpham p ON cd.id_sanpham = p.id_sanpham
                                    WHERE c.cart_status IN (0,1)
                                    GROUP BY p.id_sanpham
                                    ORDER BY total_sold DESC
                                    LIMIT 10";
                                $query_products = mysqli_query($mysqli, $sql_products);
                                $i = 1;
                                while($row = mysqli_fetch_array($query_products)) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['tensanpham']; ?></td>
                                <td><?php echo $row['total_sold']; ?></td>
                                <td><?php echo number_format($row['total_revenue'], 0, ',', '.'); ?> VNĐ</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS styles -->
<style>
    .card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: 0.3s;
        margin-bottom: 20px;
        border-radius: 15px;
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .stat-card {
        text-align: center;
    }
    .stat-card i {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
</style>

<!-- JavaScript và Chart.js -->
<script>
    <?php
        $sql_monthly = "SELECT 
            MONTH(c.updata_time) as month,
            YEAR(c.updata_time) as year,
            SUM(p.giasp * cd.soluongmua) as revenue
            FROM tbl_cart c
            JOIN tbl_cart_details cd ON c.code_cart = cd.code_cart
            JOIN tbl_sanpham p ON cd.id_sanpham = p.id_sanpham
            WHERE c.cart_status IN (0,1)
            GROUP BY YEAR(c.updata_time), MONTH(c.updata_time)
            ORDER BY YEAR(c.updata_time), MONTH(c.updata_time)
            LIMIT 12";
        $query_monthly = mysqli_query($mysqli, $sql_monthly);
        $labels = [];
        $data = [];
        while($row = mysqli_fetch_array($query_monthly)) {
            $labels[] = "Tháng " . $row['month'] . "/" . $row['year'];
            $data[] = $row['revenue'];
        }
    ?>

    var ctx = document.getElementById('revenueChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: <?php echo json_encode($data); ?>,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1,
                fill: true
            }]
        }
    });
</script>
