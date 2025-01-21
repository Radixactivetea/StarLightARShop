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
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .chart-container {
            width: 100%;
            height: 400px;
        }
    </style>
</head>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>
    <div class="grid-layout">
        <!-- navigation -->
        <?php require "src/components/seller-nav.php" ?>

        <div class="container-fluid p-5 main-content">
            <!-- Page Header -->
            <div class="row light-color text-primary p-3 mb-4">
                <div class="col">
                    <h4 class="text-center">Seller Dashboard - System Report</h4>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row g-4 mb-4">
                <!-- Total Products -->
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Products</h5>
                            <h6><i class="fas fa-box"></i> 120</h6>
                        </div>
                    </div>
                </div>

                <!-- Total Orders -->
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <h6><i class="fas fa-shopping-cart"></i> 450</h6>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenue</h5>
                            <h6><strong>RM</strong> 12,500</h6>
                        </div>
                    </div>
                </div>

                <!-- Average Rating -->
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <div class="card-body">
                            <h5 class="card-title">Average Rating</h5>
                            <h6><i class="fas fa-star"></i> 4.5</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row mb-4">
                <!-- Sales Chart -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5>Monthly Sales</h5>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Ratings Chart -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5>Ratings Distribution</h5>
                        <canvas id="ratingsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card p-3">
                        <h5>Recent Orders</h5>
                        <table class="table table-striped table-hover mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example Order Rows -->
                                <tr>
                                    <td>1</td>
                                    <td>ORD12345</td>
                                    <td>2025-01-20</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>$50.00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>ORD12346</td>
                                    <td>2025-01-19</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>$30.00</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <script>
            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Example months
                    datasets: [{
                        label: 'Sales ($)',
                        data: [500, 700, 1200, 1500, 1800, 2000, 2500], // Example data
                        borderColor: '#AF8F6',
                        backgroundColor: 'rgba(0,123,255,0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });

            // Ratings Chart
            const ratingsCtx = document.getElementById('ratingsChart').getContext('2d');
            const ratingsChart = new Chart(ratingsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
                    datasets: [{
                        label: 'Ratings',
                        data: [10, 15, 30, 25, 20], // Example data
                        backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#28a745', '#007bff']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' }
                    }
                }
            });
        </script>

        <!-- bootstap and popper -->
        <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
        <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>