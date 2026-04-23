<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders'; // nama tabel
    }

    public function rules()
    {
        return [
            [['nama', 'alamat', 'no_hp', 'metode_pembayaran'], 'required'],
            [['alamat'], 'string'],
            [['nama', 'no_hp', 'metode_pembayaran'], 'string', 'max' => 255],
        ];
    }
}
