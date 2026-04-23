
<?php
use yii\helpers\Html;

$this->title = 'Tambah Testimonial';
?>
<div class="testimonial-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form_testimonial', ['model'=>$model]) ?>
</div>
