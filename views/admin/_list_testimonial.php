
<?php
use yii\helpers\Html;

/* @var $testimonials app\models\Testimonial[] */
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Rating</th>
            <th>Isi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($testimonials as $t): ?>
        <tr>
            <td><?= Html::encode($t->name) ?></td>
            <td><?= str_repeat('⭐', $t->rating) ?></td>
            <td><?= Html::encode($t->content) ?></td>
            <td>
                <?= Html::a('Edit', ['admin/update-testimonial', 'id' => $t->id], ['class' => 'btn btn-sm btn-warning']) ?>
                <?= Html::a('Hapus', ['admin/delete-testimonial', 'id' => $t->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data-confirm' => 'Yakin hapus?',
                    'data-method' => 'post'
                ]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
