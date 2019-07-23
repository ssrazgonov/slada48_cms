<?php

namespace frontend\controllers;

use common\models\LoginForm;
use common\models\Order;
use common\models\OrderProduct;
use common\models\PaymentMehtod;
use frontend\models\Cart;
use frontend\models\PMethodForm;
use frontend\models\SignupForm;
use Yii;
use yii\helpers\ArrayHelper;

class OrderController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $userCart = Yii::$app->session->get('cart') ? Yii::$app->session->get('cart') : [];
        $productsInCart = Cart::getProducts($userCart);

        if (!$productsInCart) {
            return $this->redirect(['cart/index']);
        }

        $loginForm = new LoginForm();
        $signupForm = new SignupForm();
        $pMForm = new PMethodForm();

        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->login()) {
            return $this->refresh();
        }

		if ($signupForm->load(Yii::$app->request->post()) && $signupForm->signup()) {
			$login_data = [];
			$login_data['_csrf-frontend'] = Yii::$app->request->post()['_csrf-frontend'];
			$login_data['LoginForm'] = Yii::$app->request->post()['SignupForm'];
			if ($loginForm->load($login_data) && $loginForm->login()) {
				Yii::$app->session->setFlash('success_reg', 'Спасибо за регистрацию, вы можете продолжить оформление заказа');
				return $this->refresh();
			}
        }

		if ($pMForm->load(Yii::$app->request->post()) && $pMForm->validate()) {
		    Yii::$app->session->set('paymentMethod', Yii::$app->request->post()['PMethodForm']['paymentMethod']);
        }

        $paymentMethods = ArrayHelper::map(PaymentMehtod::find()->asArray()->all(), 'id', 'title');

        return $this->render('index', compact('productsInCart', 'loginForm','signupForm', 'paymentMethods', 'pMForm'));
    }

    public function actionCreate()
    {

        $userCart = Yii::$app->session->get('cart') ? Yii::$app->session->get('cart') : [];
        $productsInCart = Cart::getProducts($userCart);

//        var_dump($productsInCart); exit;

        $note = Yii::$app->request->post()['orderNote'];
        $user_id = Yii::$app->user->id;
        $payment_method = Yii::$app->session->get('paymentMethod');
        $amount = $userCart['sum'];

        $order = new Order();

        $order->user_id = $user_id;
        $order->amount = $amount;
        $order->payment_mehtod = $payment_method;
        $order->note = $note;

        if ($order->save()) {
            foreach ($productsInCart as $product) {
                $orderProduct = new OrderProduct();
                $orderProduct->order_id =$order->id;
                $orderProduct->product_id = $product['product']['id'];
                $orderProduct->quantity = $product['quantity'];
                $orderProduct->price = $product['price'];
                $orderProduct->product_option = $product['option']['id'];
                $orderProduct->sum = $product['sum'];

                if(!$orderProduct->save()) {
                    Yii::$app->session->setFlash('error');
                    $orderProducts = OrderProduct::find()->where(['order_id' => $order->id])->all();
                    $orderProducts->delete();
                    $order->delete();
                    return $this->redirect(['oreder/index']);
                }

            }
        } else {
            Yii::$app->session->setFlash('error');
            return $this->redirect(['order/index']);
        }

        return $this->redirect(['personal/order', 'id' => $order->id]);
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
