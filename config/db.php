<?php

return [
    'class' => 'yii\db\Connection',
    // Kita menggunakan getenv() untuk mengambil variabel yang ada di dashboard Railway
    'dsn' => 'mysql:host=' . getenv('MYSQLHOST') . ';port=' . getenv('MYSQLPORT') . ';dbname=' . getenv('MYSQLDATABASE'),
    'username' => getenv('MYSQLUSER'),
    'password' => getenv('MYSQLPASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
