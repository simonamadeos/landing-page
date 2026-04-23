<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// 🔹 Hitung cart dari session
$cart = Yii::$app->session->get('cart', []);
$cartCount = 0;
foreach ($cart as $item) {
    $cartCount += $item['qty'];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'options' => [
                'class' => 'navbar-expand-md navbar-dark my-navbar fixed-top',
            ],
            'id' => 'mainNav'
        ]);
        ?>
        <div class="d-flex justify-content-between align-items-center w-100">

            <!-- Menu kiri -->
            <div class="me-auto">
                <?php
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/landing/index']],
                    ['label' => 'Webstore', 'url' => ['/site/webstore']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                ];

                // 🔹 Tambah Cart (muncul hanya kalau ada isi)
                if ($cartCount > 0) {
                    $menuItems[] = [
                        'label' => '🛒 Cart (' . $cartCount . ')',
                        'url' => ['/cart/index']
                    ];
                }

                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                } else {
                    if (Yii::$app->user->identity->role === 'admin') {
                        $menuItems[] = ['label' => 'Dashboard', 'url' => ['/admin/index']];
                    }

                    $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline'])
                        . Html::submitButton(
                            'Logout (' . Html::encode(Yii::$app->user->identity->username) . ')',
                            ['class' => 'btn btn-link nav-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
                }

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => $menuItems,
                ]);
                ?>
            </div>

            <!-- Logo tengah -->
            <div class="mx-auto">
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
                    <img src="<?= Yii::getAlias('@web/img/logo.jpg') ?>"
                        alt="Tigers Jaw Logo"
                        class="navbar-logo">
                </a>
            </div>

            <!-- Social Media kanan -->
            <div class="ms-auto d-flex navbar-social">
                <a href="https://www.instagram.com/tigersjaw" class="nav-link" target="_blank">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://open.spotify.com/artist/0tLaqkKW7K6tc3QF9SM0M8" class="nav-link" target="_blank">
                    <i class="bi bi-spotify"></i>
                </a>
                <a href="https://www.youtube.com/channel/UC5LogF3cSx64B4Bf3HE2TJg" class="nav-link" target="_blank">
                    <i class="bi bi-youtube"></i>
                </a>
                <a href="https://web.facebook.com/tigersjaw?_rdc=1&_rdr#" class="nav-link" target="_blank">
                    <i class="bi bi-facebook"></i>
                </a>
            </div>
        </div>
        <?php NavBar::end(); ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3">
        <div class="container">
            <div class="row footer-text">
                <div class="col-md-6 text-center text-md-start">&copy; Tigers Jaw. All Rights Reserved. <?= date('Y') ?></div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
