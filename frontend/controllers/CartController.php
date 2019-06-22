<?php


namespace frontend\controllers;


use common\models\Product;
use common\models\ProductCategory;
use frontend\models\Cart;
use phpDocumentor\Reflection\Types\Object_;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class CartController extends Controller
{

    public function actionIndex() {
        $userCart = Yii::$app->session->get('cart') ? Yii::$app->session->get('cart') : [];

        $productsInCart = Cart::getProducts($userCart);

        return $this->render('index', compact('productsInCart'));
    }

    public function actionCartAdd() {

        if ( Yii::$app->request->isPost) {
            $userCart = Yii::$app->session->get('cart') ? Yii::$app->session->get('cart') : [];
            $userCart[] = Yii::$app->request->post();
            Yii::$app->session->set('cart', $userCart);

            Yii::$app->session->setFlash('success_add');

            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionCartDelete() {

        if ( Yii::$app->request->isPost) {
            $userCart = Yii::$app->session->get('cart') ? Yii::$app->session->get('cart') : [];
            $product_id = Yii::$app->request->post()['prod_id'];
            array_splice($userCart, $product_id, 1);
            Yii::$app->session->set('cart', $userCart);

            Yii::$app->session->setFlash('success_delete');

            return $this->redirect(Url::to(['cart/index']));
        }
    }

}