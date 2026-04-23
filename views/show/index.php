
<?php
use yii\helpers\Html;
?>

<!-- Shows Section -->
<section class="shows">
  <div class="container">
    <h2>SHOWS</h2>

    <?php foreach ($shows as $show): ?>
      <div class="show-item">
        <div class="show-date">
          <strong><?= strtoupper(date('M d', strtotime($show->show_date))) ?></strong>
          <?= Html::encode($show->day_name) ?>
        </div>
        <div class="show-details">
          <h3><?= Html::encode($show->venue) ?> @ <?= Html::encode($show->time) ?></h3>
          <p>w/ <?= Html::encode($show->performers) ?></p>
          <p><?= Html::encode($show->location) ?></p>
        </div>
        <div class="show-actions">
          <a href="#" class="btn-outline">Tickets</a>
          <a href="#" class="btn-outline">RSVP</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<style>
  .shows { background: #a94f28; color: #fff; padding: 40px 20px; }
  .shows h2 { text-align: center; margin-bottom: 30px; color: #9ee7d3; font-weight: bold; letter-spacing: 2px; }
  .show-item { display: flex; justify-content: space-between; align-items: center; padding: 15px 10px; border-bottom: 1px solid rgba(255,255,255,0.2); }
  .show-date { width: 120px; font-size: 14px; text-transform: uppercase; }
  .show-date strong { display: block; font-size: 18px; margin-bottom: 5px; }
  .show-details { flex: 1; padding: 0 20px; }
  .show-details h3 { margin: 0; font-size: 18px; }
  .show-actions { display: flex; gap: 10px; }
  .btn-outline { border: 1px solid #fff; padding: 6px 14px; text-decoration: none; color: #fff; font-size: 14px; transition: all 0.3s; }
  .btn-outline:hover { background: #fff; color: #a94f28; }
</style>
