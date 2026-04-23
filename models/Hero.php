<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Hero extends ActiveRecord
{
    public static function tableName()
    {
        return 'hero'; // tabel di database
    }

    public function upload()
    {
        if ($this->background_image instanceof UploadedFile) {
            $path = 'uploads/' . $this->background_image->baseName . '.' . $this->background_image->extension;
            if ($this->background_image->saveAs(\Yii::getAlias('@webroot') . '/' . $path)) {
                // ubah property jadi path string supaya bisa disimpan di DB
                $this->background_image = '/' . $path;
                return true;
            }
        }
        return false;
    }
    public function rules()
    {
        return [
            [['title', 'subtitle', 'button_text', 'button_link'], 'string', 'max' => 255],
            [['background_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }
}
