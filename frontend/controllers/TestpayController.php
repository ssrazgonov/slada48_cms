<?php


namespace frontend\controllers;

use common\models\Auction;
use common\models\Product;
use common\models\Bid;
use common\models\User;
use yii\web\Controller;
use Yii;

class TestpayController extends Controller
{
    public function actionIndex() {


        if (Yii::$app->request->post()) {
            $invoice = \pantera\yii2\pay\sberbank\models\Invoice::addSberbank(1, 1);

            return $this->render('index', compact('invoice'));
        }

        return $this->render('index');
    }

    public function actionSuccess()
    {
        return $this->render('success');
    }

    public function actionFail()
    {
        return $this->render('error');
    }

}