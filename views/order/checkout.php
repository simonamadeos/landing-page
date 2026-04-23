<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Checkout';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4 text-center">Checkout</h1>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nama')->textInput() ?>
            <?= $form->field($model, 'alamat')->textarea() ?>
            <?= $form->field($model, 'no_hp')->textInput() ?>
            <?= $form->field($model, 'metode_pembayaran')->dropDownList([
                'COD' => 'Cash on Delivery',
                'Transfer' => 'Transfer Bank'
            ]) ?>

            <p class="fw-bold">Total: Rp <?= number_format($total, 0, ',', '.') ?></p>

            <div class="form-group">
                <?= Html::submitButton('Simpan Order', ['class' => 'btn btn-primary w-100']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
