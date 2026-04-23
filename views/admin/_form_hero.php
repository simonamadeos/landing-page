<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $hero app\models\Hero */
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="custom-alert success-alert">
        <?= Yii::$app->session->getFlash('success') ?>
        <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
<?php endif; ?>


<h3>Edit Hero Section</h3>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($hero, 'title')->textInput(['maxlength' => true]) ?>
<?= $form->field($hero, 'subtitle')->textInput(['maxlength' => true]) ?>
<?= $form->field($hero, 'button_text')->textInput(['maxlength' => true]) ?>
<?= $form->field($hero, 'button_link')->textInput(['maxlength' => true]) ?>

<?php if ($hero->background_image): ?>
    <div style="margin-bottom:10px;">
        <label>Current Background Image:</label><br>
        <img src="<?= $hero->background_image ?>" style="max-width:300px; border:1px solid #ccc;">
    </div>
<?php endif; ?>

<?= $form->field($hero, 'background_image')->fileInput() ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

