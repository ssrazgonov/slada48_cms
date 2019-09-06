<?php

namespace frontend\controllers;

use common\models\Order;
use Yii;

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
    
    public function actionOrders()
    {
        $orders = Order::find()->where(['user_id' => Yii::$app->user->id])->all();

        return $this->render('orders', compact('orders'));
    }

}