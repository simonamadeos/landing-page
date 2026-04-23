<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model app\models\Testimonial */

$form = ActiveForm::begin();
echo $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nama / Media');
echo $form->field($model, 'rating')->dropDownList([
    1=>'1 ⭐',2=>'2 ⭐',3=>'3 ⭐',4=>'4 ⭐',5=>'5 ⭐'
], ['prompt'=>'Pilih rating']);
echo $form->field($model, 'content')->textarea(['rows' => 3])->label('Isi Testimonial');
echo Html::submitButton('Simpan', ['class' => 'btn btn-primary']);
ActiveForm::end();
?>
