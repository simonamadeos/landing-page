<?php

return [
    'class' => 'yii\db\Connection',
    // Gunakan getenv() untuk mengambil data dari Railway
    'dsn' => 'mysql:host=' . getenv('MYSQLHOST') . ';port=' . getenv('MYSQLPORT') . ';dbname=' . getenv('MYSQLDATABASE'),
    'username' => getenv('MYSQLUSER'),
    'password' => getenv('MYSQLPASSWORD'),
    'charset' => 'utf8mb4',

    // Schema cache options (opsional)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];