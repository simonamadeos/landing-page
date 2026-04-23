<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Keranjang Belanja';
?>

<div class="container py-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Flash message -->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= Yii::$app->session->getFlash('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <?php if (empty($cart)): ?>
        <p>Keranjang masih kosong.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $grandTotal = 0; ?>
                <?php foreach ($cart as $item): ?>
                    <?php
                    $total = $item['price'] * $item['qty'];
                    $grandTotal += $total;
                    ?>
                    <tr>
                        <td><?= Html::encode($item['name']) ?></td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td>
                            <form action="<?= Url::to(['cart/update', 'id' => $item['id']]) ?>" method="post" style="display:flex; gap:5px;">
                                <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" class="form-control" style="width:80px;">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                        <td>Rp <?= number_format($total, 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= Url::to(['cart/remove', 'id' => $item['id']]) ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus produk ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td colspan="2"><strong>Rp <?= number_format($grandTotal, 0, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>

        <a href="<?= Url::to(['cart/clear']) ?>"
            class="btn btn-danger"
            onclick="return confirm('Yakin kosongkan keranjang?')">
            Kosongkan Keranjang
        </a>
        <p>
            <a href="<?= \yii\helpers\Url::to(['order/checkout']) ?>" class="btn btn-success">
                Checkout
            </a>
        </p>
    <?php endif; ?>
</div>