<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelShow app\models\Show */
?>

<div class="show-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelShow, 'show_date')->textInput(['type' => 'date']) ?>
    <?= $form->field($modelShow, 'day_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($modelShow, 'time')->textInput(['type' => 'time']) ?>
    <?= $form->field($modelShow, 'venue')->textInput(['maxlength' => true]) ?>
    <?= $form->field($modelShow, 'location')->textInput(['maxlength' => true]) ?>
    <?= $form->field($modelShow, 'performers')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
