<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Hero;
use app\models\Product;
use app\models\Show;
use app\models\Testimonial;
use app\models\Order;
use app\models\User;

class AdminController extends Controller
{
    public function actionIndex()
    {
        // === Data Hero ===
        $hero = Hero::find()->one();

        // === Data Produk ===
        $products = Product::find()->all();

        // === Data Jadwal Konser ===
        $shows = Show::find()->orderBy(['show_date' => SORT_ASC])->all();
        $modelShow = new Show();

        // === Data Testimonial ===
        $modelTestimonial = new Testimonial();
        $testimonials = Testimonial::find()->all();

        // === Data Dashboard (Summary) ===
        $totalProducts = Product::find()->count();
        $totalOrders = Order::find()->count();
        $totalCustomers = User::find()->count();

        // === Grafik Order per Bulan (Line/Bar Chart) ===
        $ordersPerMonth = (new \yii\db\Query())
            ->select(["MONTH(created_at) as month", "COUNT(*) as total"])
            ->from('orders')
            ->groupBy('MONTH(created_at)')
            ->all();

        $months = [];
        $totals = [];
        foreach ($ordersPerMonth as $row) {
            $months[] = date("F", mktime(0, 0, 0, $row['month'], 1));
            $totals[] = $row['total'];
        }

        // === Grafik Metode Pembayaran (Pie Chart) ===
        $paymentMethods = (new \yii\db\Query())
            ->select(["metode_pembayaran", "COUNT(*) as total"])
            ->from('orders')
            ->groupBy('metode_pembayaran')
            ->all();

        $paymentLabels = [];
        $paymentTotals = [];
        foreach ($paymentMethods as $row) {
            $paymentLabels[] = $row['metode_pembayaran'];
            $paymentTotals[] = $row['total'];
        }

        // === Grafik Produk Terlaris (Bar/Pie Chart) ===
        $bestSelling = (new \yii\db\Query())
            ->select(['p.name as nama_produk', 'SUM(c.quantity) as total'])
            ->from('cart c')
            ->innerJoin('products p', 'c.product_id = p.id')
            ->groupBy('c.product_id')
            ->orderBy(['total' => SORT_DESC])
            ->limit(5)
            ->all();

        $topProductLabels = [];
        $topProductTotals = [];
        foreach ($bestSelling as $row) {
            $topProductLabels[] = $row['nama_produk'];
            $topProductTotals[] = (int) $row['total'];
        }

        // === Proses Update Hero ===
        $oldImage = $hero->background_image;
        if ($hero->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($hero, 'background_image');
            if ($file) {
                $fileName = 'hero_' . time() . '.' . $file->extension;
                $file->saveAs('uploads/' . $fileName);
                $hero->background_image = '/uploads/' . $fileName;
            } else {
                $hero->background_image = $oldImage;
            }

            if ($hero->save(false)) {
                Yii::$app->session->setFlash('success', 'Hero berhasil diperbarui');
                return $this->refresh();
            }
        }

        // === Simpan Show Baru ===
        if ($modelShow->load(Yii::$app->request->post()) && $modelShow->save()) {
            Yii::$app->session->setFlash('success', 'Jadwal konser baru berhasil disimpan');
            return $this->refresh();
        }

        // === Simpan Testimonial Baru ===
        if ($modelTestimonial->load(Yii::$app->request->post()) && $modelTestimonial->save()) {
            Yii::$app->session->setFlash('success', 'Testimonial baru berhasil disimpan');
            return $this->refresh();
        }

        // === Kirim Semua Data ke View ===
        return $this->render('index', [
            // Data tab
            'hero' => $hero,
            'products' => $products,
            'shows' => $shows,
            'modelShow' => $modelShow,
            'modelTestimonial' => $modelTestimonial,
            'testimonials' => $testimonials,

            // Data dashboard
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'months' => $months,
            'totals' => $totals,
            'paymentLabels' => $paymentLabels,
            'paymentTotals' => $paymentTotals,
            'topProductLabels' => $topProductLabels,
            'topProductTotals' => $topProductTotals,
        ]);
    }
}
