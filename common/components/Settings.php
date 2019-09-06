<?php


namespace common\components;


use yii\base\Component;
use yii\base\Widget;

class Settings extends Component
{
    public $set;

    public function init()
    {
        $this->set = \common\models\Settings::findOne(['type' => 'settings']);
    }

    public function test() {
        return 'test';
    }

}