<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        :root {
            --primary-bg: #f8f9fa;
            --card-bg: #ffffff;
        }

        .stat-card {
            background: rgba(175, 143, 111, 0.1);
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .chart-container {
            background: rgba(175, 143, 111, 0.1);
            border-radius: 15px;
            padding: 20px;
            height: 400px;
            margin-bottom: 20px;
        }

        .orders-table {
            background: rgba(175, 143, 111, 0.1);
            border-radius: 15px;
            padding: 20px;
        }

        .table> :not(caption)>*>* {
            padding: 1rem;
        }

        .dashboard-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .dashboard-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: #AF8F6F;
            border-radius: 2px;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .stat-card .label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .progress {
            height: 8px;
            --bs-progress-bar-bg: #AF8F6F;
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(13, 110, 253, 0.1);
            border-radius: 8px;
        }
    </style>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="grid-layout">
        <!-- navigation -->
        <?php require "src/components/seller-nav.php" ?>

        <div class="container-fluid p-4 main-content">
            <h2 class="dashboard-title">Seller Dashboard</h2>

            <!-- Stats Row -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stat-card card h-100">
                        <div class="card-body">
                            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-box fa-lg"></i>
                            </div>
                            <div class="value"><?= $summary['total_products'] ?></div>
                            <div class="label">Total Products</div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar"
                                    style="width: <?= $summary['total_products'] ?>%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stat-card card h-100">
                        <div class="card-body">
                            <div class="stat-icon bg-success bg-opacity-10 text-success">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                            </div>
                            <div class="value"><?= $summary['total_orders'] ?></div>
                            <div class="label">Total Orders</div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar"
                                    style="width: <?= $summary['order_percentage'] ?>%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stat-card card h-100">
                        <div class="card-body">
                            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-dollar-sign fa-lg"></i>
                            </div>
                            <div class="value">RM <?= $summary['total_revenue'] ?></div>
                            <div class="label">Total Revenue</div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar"
                                    style="width: <?= $summary['revenue_percentage'] ?>%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stat-card card h-100">
                        <div class="card-body">
                            <div class="stat-icon bg-info bg-opacity-10 text-info">
                                <i class="fas fa-star fa-lg"></i>
                            </div>
                            <div class="value"><?= $summary['average_rating'] ?></div>
                            <div class="label">Average Rating</div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar"
                                    style="width: <?= $summary['rating_percentage'] ?>%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-8">
                    <div class="chart-container">
                        <h5 class="mb-4">Monthly Sales</h5>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="chart-container">
                        <h5 class="mb-4">Ratings Distribution</h5>
                        <canvas id="ratingsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="orders-table">
                <h5 class="mb-4">Recent Orders</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="light-color">
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Tracking</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($latestOrder as $order): ?>
                                <tr>
                                    <td>
                                        <span class="fw-medium">#ORD<?= $order['order_id'] ?></span>
                                    </td>
                                    <td><?= $order['date'] ?></td>
                                    <td>RM <?= $order['total_price'] ?></td>
                                    <td><?= $order['tracking_number'] ?? 'N/A' ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
        <script>
            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Sales (RM)',
                        data: [500, 700, 1200, 1500, 1800, 2000, 2500],
                        borderColor: '#74512D',
                        backgroundColor: 'rgba(175, 143, 111, 0.2)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#74512D',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [2, 2]
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Ratings Chart
            const ratingsCtx = document.getElementById('ratingsChart').getContext('2d');
            new Chart(ratingsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
                    datasets: [{
                        data: [10, 15, 30, 25, 20],
                        backgroundColor: [
                            'rgba(220, 53, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(13, 202, 240, 0.8)',
                            'rgba(13, 110, 253, 0.8)',
                            'rgba(25, 135, 84, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        </script>

        <!-- bootstap and popper -->
        <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
        <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>