<?php
use yii\helpers\Html;

/* @var $shows app\models\Show[] */
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Hari</th>
            <th>Waktu</th>
            <th>Venue</th>
            <th>Lokasi</th>
            <th>Performer</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shows as $show): ?>
            <tr>
                <td><?= $show->show_date ?></td>
                <td><?= $show->day_name ?></td>
                <td><?= $show->time ?></td>
                <td><?= $show->venue ?></td>
                <td><?= $show->location ?></td>
                <td><?= $show->performers ?></td>
                <td>
                    <?= Html::a('Edit', ['admin/update-show', 'id' => $show->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('Hapus', ['admin/delete-show', 'id' => $show->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => 'Yakin mau hapus data ini?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
