<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model app\models\Product */
?>

<h3>Tambah Produk</h3>

<?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength'=>true]) ?>
<?= $form->field($model, 'description')->textarea(['rows'=>4]) ?>
<?= $form->field($model, 'price')->textInput(['type'=>'number','step'=>'0.01']) ?>
<?= $form->field($model, 'imageFile')->fileInput() ?>

<div class="form-group">
    <?= Html::submitButton('Simpan', ['class'=>'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
