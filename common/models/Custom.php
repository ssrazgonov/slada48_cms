<?php


namespace common\models;


use yii\base\Model;

class Custom extends Model
{
    public $weight;
    public $text;
    public $comment;
    public $datetime;

    public function rules()
    {
        return [
            [['weight', 'text', 'comment', 'datetime'], 'safe']
        ];
    }
}