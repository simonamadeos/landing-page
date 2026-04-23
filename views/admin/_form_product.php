<?php
use yii\helpers\Html;

/* @var $products app\models\Product[] */
?>
<h3>Kelola Produk</h3>
<p><?= Html::a('Tambah Produk', ['product/create'], ['class'=>'btn btn-success']) ?></p>

<div style="display:flex;flex-wrap:wrap;gap:20px;">
    <?php foreach ($products as $p): ?>
        <div style="width:220px;padding:12px;background:#fff;border-radius:8px;text-align:center;">
            <?php if ($p->image): ?>
                <?= Html::img(Yii::getAlias('@web') . '/' . $p->image, ['width'=>180, 'style'=>'object-fit:cover;border-radius:6px;']) ?>
            <?php endif; ?>
            <h4><?= Html::encode($p->name) ?></h4>
            <p><strong>Rp <?= number_format($p->price,0,',','.') ?></strong></p>
            <p>
                <?= Html::a('Edit', ['product/edit','id'=>$p->id], ['class'=>'btn btn-warning btn-sm']) ?>
                <?= Html::a('Hapus', ['product/delete','id'=>$p->id], [
                    'class'=>'btn btn-danger btn-sm',
                    'data' => ['confirm' => 'Yakin mau hapus produk ini?']
                ]) ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>
