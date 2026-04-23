
<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Show */

$this->title = 'Tambah Jadwal Konser';
?>

<div class="show-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@app/views/admin/_form_show', ['model' => $model]) ?>
</div>
