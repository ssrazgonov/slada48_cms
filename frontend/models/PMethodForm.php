<?php


namespace frontend\models;


use yii\base\Model;

class PMethodForm extends Model
{
    public $paymentMethod;

    public function rules()
    {
        return [
            ['paymentMethod','required'],
        ];
    }
}