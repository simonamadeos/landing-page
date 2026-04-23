<?php
use yii\helpers\Html;
?>

<div class="hero" style="background-image:url('/img/hero.jpg'); background-size:cover; background-position:center; min-height:100vh; display:flex; align-items:center; justify-content:center; flex-direction:column; text-align:center; color:#fff;">

    <h1 style="font-size:48px; font-weight:bold; margin-bottom:20px;">
        Terima Kasih, Pesanan Anda Berhasil!
    </h1>

    <p style="font-size:20px; margin-bottom:40px;">
        Berikut detail pesanan Anda:
    </p>

    <div style="background:rgba(0,0,0,0.6); padding:30px; border-radius:12px; display:inline-block; text-align:left; min-width:300px;">
        <p><strong>Nama:</strong> <?= Html::encode($order->nama) ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($order->total, 0, ',', '.') ?></p>
        <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($order->created_at)) ?></p>
    </div>

    <div style="margin-top:40px;">
        <?= Html::a('Kembali ke Home', ['landing/index'], [
            'class' => 'btn btn-lg',
            'style' => 'background:#b54b2e; border:none; color:#fff; padding:15px 30px; border-radius:8px; font-size:18px; text-decoration:none;'
        ]) ?>
    </div>

</div>
