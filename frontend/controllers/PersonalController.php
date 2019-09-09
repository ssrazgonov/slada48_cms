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

        $invoice = null;

        if ($order->payment_method == 2) {
            $invoice = \pantera\yii2\pay\sberbank\models\Invoice::addSberbank($order->id, $order->amount);
        }


        return $this->render('order', compact('order', 'invoice'));
    }
    
    public function actionOrders()
    {
        $orders = Order::find()->where(['user_id' => Yii::$app->user->id])->all();

        $invoices = [];

        foreach ($orders as $order) {
            $invoices[$order->id] = \pantera\yii2\pay\sberbank\models\Invoice::addSberbank($order->id, $order->amount);
        }

        return $this->render('orders', compact('orders', 'invoices'));
    }

}