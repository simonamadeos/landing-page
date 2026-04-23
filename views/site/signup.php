<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Silakan isi data berikut untuk membuat akun baru:</p>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group mt-3">
            <?= Html::submitButton('Daftar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
