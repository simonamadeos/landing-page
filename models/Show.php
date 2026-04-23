<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Show extends ActiveRecord
{
    public static function tableName()
    {
        return 'shows'; // tabel di database
    }

    public function rules()
    {
        return [
            [['show_date', 'time', 'venue', 'location'], 'required'],
            [['show_date'], 'date', 'format' => 'php:Y-m-d'],
            [['time'], 'string', 'max' => 20],
            [['venue', 'location'], 'string', 'max' => 255],
            [['performers'], 'string', 'max' => 255],
            [['day_name'], 'string', 'max' => 50],
            [['ticket_link', 'rsvp_link'], 'string', 'max' => 255], // 🔥 tambahan
        ];
    }
}
