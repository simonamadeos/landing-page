<?php
/** @var int $totalProducts */
/** @var int $totalOrders */
/** @var int $totalCustomers */
/** @var array $months */
/** @var array $totals */
/** @var array $paymentLabels */
/** @var array $paymentTotals */
/** @var array $topProductLabels */
/** @var array $topProductTotals */
?>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Produk</h5>
                <p class="display-6"><?= $totalProducts ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Order</h5>
                <p class="display-6"><?= $totalOrders ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Customer</h5>
                <p class="display-6"><?= $totalCustomers ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Order per Bulan -->
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Trend Order per Bulan</h5>
                <canvas id="ordersLineChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <!-- Metode Pembayaran -->
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Metode Pembayaran</h5>
                <canvas id="paymentPieChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Produk Terlaris -->
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Produk Terlaris</h5>
                <canvas id="bestProductsBarChart" height="150"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// ===== Line Chart (Order per Bulan) =====
const ctxLine = document.getElementById('ordersLineChart').getContext('2d');
new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: <?= json_encode($months) ?>,
        datasets: [{
            label: 'Jumlah Order',
            data: <?= json_encode($totals) ?>,
            fill: true,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});

// ===== Pie Chart (Metode Pembayaran) =====
const ctxPie = document.getElementById('paymentPieChart').getContext('2d');
new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: <?= json_encode($paymentLabels) ?>,
        datasets: [{
            data: <?= json_encode($paymentTotals) ?>,
            backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF']
        }]
    },
    options: { responsive: true }
});

// ===== Bar Chart (Produk Terlaris) =====
const ctxBar = document.getElementById('bestProductsBarChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: <?= json_encode($topProductLabels) ?>,
        datasets: [{
            label: 'Jumlah Terjual',
            data: <?= json_encode($topProductTotals) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
    }
});
</script>
