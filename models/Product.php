<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public $imageFile; // dipakai untuk upload (fileInput)

    public static function tableName()
    {
        return 'products';
    }

    public function rules()
{
    return [
        [['name', 'price'], 'required'],
        [['price'], 'number'],
        [['description'], 'string'],
        [['image'], 'string', 'max' => 255],
        [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
    ];
}


    public function attributeLabels()
    {
        return [
            'imageFile' => 'Gambar Produk',
        ];
    }
}
