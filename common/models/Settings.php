<?php

namespace common\models;

use Yii;

class Settings extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'settings';
    }

}
