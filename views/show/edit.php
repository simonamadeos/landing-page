
<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Show */

$this->title = 'Edit Jadwal Konser: ' . $model->venue;
?>

<div class="show-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_show', [
        'model' => $model,
    ]) ?>
</div>
