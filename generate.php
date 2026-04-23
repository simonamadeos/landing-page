<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/config/web.php';
new yii\web\Application($config);

// generate hash untuk password "admin123"
echo Yii::$app->security->generatePasswordHash('admin123');
