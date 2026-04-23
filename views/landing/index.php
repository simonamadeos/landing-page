<?php
/* @var $this yii\web\View */
/* @var $hero app\models\Hero */
/* @var $products array|\app\models\Product[] */

use yii\helpers\Html;

$this->title = 'Landing Page Tigers Jaw';
?>

<!-- Hero Section -->
<section class="hero" style="background-image:url('<?= $hero->background_image ?>')">
  <div class="hero-content">
    <h1><?= $hero->title ?></h1>
    <p><?= $hero->subtitle ?></p>
    <a href="<?= $hero->button_link ?>" class="btn"><?= $hero->button_text ?></a>
  </div>
</section>

<!-- Value Proposition -->
<section class="value-prop">
  <div class="container">
    <h2>About Us – Tigers Jaw</h2>
    <p>Tigers Jaw adalah band indie rock/emo asal Scranton, Pennsylvania, yang terbentuk pada 2005. Dengan perpaduan melodi catchy, lirik jujur, dan nuansa emosional, Tigers Jaw dikenal sebagai salah satu band penting dalam perkembangan musik emo modern. Meski mengalami perubahan formasi, mereka tetap konsisten merilis karya penuh energi dan emosi yang dekat dengan pendengar.</p>
  </div>
</section>

<section class="value-images">
  <div class="value-images-grid">
    <div class="value-image-item">
      <img src="/img/tigers1.jpg" alt="Foto Kiri">
    </div>
    <div class="value-image-item">
      <img src="/img/prod2.jpg" alt="Foto Kanan">
    </div>
  </div>
</section>

<!-- Shows Section -->
<section class="shows">
  <div class="container">
    <h2>SHOWS</h2>

    <?php if (!empty($shows)): ?>
      <?php foreach ($shows as $show): ?>
        <div class="show-item">
          <div class="show-date">
            <strong><?= strtoupper(date('M d', strtotime($show->show_date))) ?></strong>
            <?= strtoupper(date('D', strtotime($show->show_date))) ?>
          </div>
          <div class="show-details">
            <h3><?= Html::encode($show->venue) ?> @ <?= Html::encode($show->time) ?></h3>
            <p>w/ <?= Html::encode($show->performers) ?></p>
            <p><?= Html::encode($show->location) ?></p>
          </div>
          <div class="show-actions">
            <?php if ($show->ticket_link): ?>
              <a href="<?= Html::encode($show->ticket_link) ?>" class="btn-outline" target="_blank">Tickets</a>
            <?php endif; ?>
            <?php if ($show->rsvp_link): ?>
              <a href="<?= Html::encode($show->rsvp_link) ?>" class="btn-outline" target="_blank">RSVP</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Tidak ada jadwal konser tersedia.</p>
    <?php endif; ?>

  </div>
</section>


<!-- Produk / Album / Merch -->
<section id="produk" class="produk">
  <div class="container">
    <h2>Album & Merchandise</h2>
    <div class="produk-grid">
      <?php foreach ($products as $product): ?>
        <?php
        $id    = is_array($product) ? $product['id'] : $product->id;
        $img   = is_array($product) ? $product['img'] : Yii::getAlias('@web/' . $product->image);
        $name  = is_array($product) ? $product['name'] : $product->name;
        $price = is_array($product) ? $product['price'] : $product->price;
        $desc  = is_array($product) ? ($product['description'] ?? '') : $product->description;
        ?>
        <div class="produk-item">
          <img src="<?= $img ?>" alt="<?= $name ?>">
          <h3><?= $name ?></h3>
          <p><strong>Rp <?= number_format($price, 0, ',', '.') ?></strong></p>
          <?php if (!empty($desc)): ?>
            <p><small><?= $desc ?></small></p>
          <?php endif; ?>

          <!-- Form untuk tambah ke keranjang -->
          <form action="<?= \yii\helpers\Url::to(['cart/add', 'id' => $id]) ?>" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
              value="<?= Yii::$app->request->csrfToken ?>">
            <button type="submit" class="btn-cta">Beli Sekarang</button>
          </form>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- YouTube Section -->
<section class="youtube-section">
  <div class="container">
    <h2>Tonton Video Musik Kami di YouTube</h2>

    <div class="youtube-main-video">
      <iframe width="100%" height="600"
        src="https://www.youtube.com/embed/ecE4ytbuiVA?si=ZqAhNrS-auqUvi4c"
        title="Video Musik 1" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
      </iframe>
    </div>

    <div class="youtube-grid">
      <div class="youtube-item">
        <iframe width="100%" height="315"
          src="https://www.youtube.com/embed/ViktgnvKIeE?si=JKx6SHX9P-rVQ9G3"
          title="Video Musik 2" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>

      <div class="youtube-item">
        <iframe width="100%" height="315"
          src="https://www.youtube.com/embed/ViySXd1YWr0?si=dTccF5aInYF65chl"
          title="Video Musik 3" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>
    </div>
  </div>
</section>

<!-- Testimoni -->
<section class="testimoni">
  <div class="container">
    <h2>Kata Mereka</h2>
    <div class="testimoni-grid">
      <?php if (!empty($testimonials)): ?>
        <?php foreach ($testimonials as $item): ?>
          <div class="testimoni-item">
            <div class="stars">
              <?= str_repeat('★', (int)$item->rating) ?>
            </div>
            <p class="quote">“<?= \yii\helpers\Html::encode($item->content) ?>”</p>
            <p class="author">– <?= \yii\helpers\Html::encode($item->name) ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Belum ada testimoni.</p>
      <?php endif; ?>
    </div>
  </div>
</section>



<!-- Newsletter -->
<section class="newsletter">
  <div class="container">
    <h2>Jangan Ketinggalan Update</h2>
    <p>Daftar ke newsletter kami untuk update tour, rilis, dan promo spesial.</p>
    <form>
      <input type="email" placeholder="Masukkan email kamu">
      <button type="submit">Daftar</button>
    </form>
  </div>
</section>