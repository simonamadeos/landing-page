<?php
namespace app\models;

use yii\db\ActiveRecord;

class Testimonial extends ActiveRecord
{
    public static function tableName()
    {
        return 'testimonial';
    }

    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            ['rating', 'integer', 'min' => 1, 'max' => 5],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}
