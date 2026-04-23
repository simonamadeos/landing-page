<?php

/** @var yii\web\View $this */
/** @var app\models\Product[]|array $products */

use yii\helpers\Url;

$this->title = 'Web Store';
?>

<div class="store-page container py-5">
    <h1 class="text-center mb-4">Web Store</h1>
    <p class="text-center mb-5">Lihat dan beli produk resmi kami di bawah ini.</p>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <?php
            // Sama seperti di landing page → hybrid handling
            $img   = is_array($product) ? $product['img'] : Yii::getAlias('@web/' . $product->image);
            $name  = is_array($product) ? $product['name'] : $product->name;
            $price = is_array($product) ? $product['price'] : 'Rp ' . number_format($product->price, 0, ',', '.');
            $desc  = is_array($product) ? ($product['description'] ?? '') : $product->description;
            ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 product-card">
                    <img src="<?= $img ?>" class="card-img-top" alt="<?= $name ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $name ?></h5>
                        <p class="card-text"><?= $price ?></p>
                        <?php if (!empty($desc)): ?>
                            <p class="text-muted"><small><?= $desc ?></small></p>
                        <?php endif; ?>
                        <a href="<?= Url::to(['/cart/add', 'id' => is_array($product) ? $product['id'] : $product->id]) ?>"
                            class="btn btn-primary">
                            Tambah ke Keranjang
                        </a>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>