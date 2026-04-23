
<?php
use yii\helpers\Html;

$this->title = 'Edit Testimonial';
?>
<div class="testimonial-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form_testimonial', ['model'=>$model]) ?>
</div>
