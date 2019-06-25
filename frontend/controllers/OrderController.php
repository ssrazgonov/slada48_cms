<?php

namespace frontend\controllers;

class OrderController extends \yii\web\Controller
{
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionConfirm()
    {
        return $this->render('create');
    }

    public function actionRegister()
    {
        return $this->render('register');
    }

}
