<?php

namespace frontend\controllers;

use common\models\Order;

class PersonalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOrder($id)
    {
        $order = Order::findOne($id);

        return $this->render('order', compact('order'));
    }

}
