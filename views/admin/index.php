<?php
use yii\bootstrap5\Tabs;

/* @var $this yii\web\View */
$this->title = 'Admin Panel';
?>

<div class="admin-dashboard">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Dashboard',
                'content' => $this->render('_tab_dashboard', [
                    'totalProducts'    => $totalProducts,
                    'totalOrders'      => $totalOrders,
                    'totalCustomers'   => $totalCustomers,
                    'months'           => $months,
                    'totals'           => $totals,
                    'paymentLabels'    => $paymentLabels,
                    'paymentTotals'    => $paymentTotals,
                    'topProductLabels' => $topProductLabels,
                    'topProductTotals' => $topProductTotals,
                ]),
                'active' => true
            ],
           // ================= Hero Section =================
        [
            'label' => 'Hero Section',
            'content' => $this->render('_form_hero', [
                'hero' => $hero
            ]),
        ],

        // ================= Produk =================
        [
            'label' => 'Produk',
            'content' => $this->render('_form_product', [
                'products' => $products
            ]),
        ],

        // ================= Jadwal Konser =================
        [
            'label' => 'Jadwal Konser',
            'content' => $this->render('_form_show', [
                'modelShow' => $modelShow
            ]),
        ],

        // ================= Daftar Konser =================
        [
            'label' => 'Daftar Konser',
            'content' => $this->render('_list_show', [
                'shows' => $shows
            ]),
        ],

        // ================= Testimonial =================
        [
            'label' => 'Testimonial',
            'content' =>
                $this->render('_form_testimonial', [
                    'model' => $modelTestimonial
                ]) .
                "<h3>Daftar Testimonial</h3>" .
                $this->render('_list_testimonial', [
                    'testimonials' => $testimonials
                ]),
        ],
    ],
]); ?>