<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
?>

<h1>Edit Product</h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
<?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.01']) ?>

<?php if ($model->image): ?>
    <div style="margin:10px 0;">
        <label>Current Image:</label><br>
        <img src="<?= Yii::getAlias('@web') . '/' . $model->image ?>" 
             alt="Product Image" 
             style="max-width:200px; border:1px solid #ccc;">
    </div>
<?php endif; ?>

<?= $form->field($model, 'imageFile')->fileInput() ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
