<?php

namespace frontend\models;

use yii\base\Model;

/**
 * simple test model for form
 */
class Custom extends Model
{

    public $weight;
    public $text;
    public $comment;
    public $datetime;
    public $payment;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weight', 'payment'], 'required'],
            ['weight', 'compare', 'compareValue' => 2, 'operator' => '>=', 'type' => 'number'],
            [['text', 'comment', 'datetime'], 'trim']
        ];
    }

    public function attributeLabels()
    {
        return [
            'weight' => 'Масса'
        ];
    }


}