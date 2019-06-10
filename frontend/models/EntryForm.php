<?php

namespace frontend\models;

use yii\base\Model;

/**
 * simple test model for form
 */
class EntryForm extends Model
{   
    /**
     * @var name name of user
     * @var email email of user
     */
    public $name;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email']
        ];
    }


}