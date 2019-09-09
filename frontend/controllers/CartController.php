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

        return $this->render('index', compact('productsInCart', 'userCart'));
    }

    public function actionCartAdd() {

        if ( Yii::$app->request->isPost) {

            $userCart = Yii::$app->session->get('cart') ? Yii::$app->session->get('cart') : [];

            $productTmp = Yii::$app->request->post();
            $product = Product::find()->where(['id' => $productTmp['product_id']])->one();

//            $product_sum = $product->price_type_id === 1 ?
//                           $product->price * $productTmp['product_quantity'] /1000 :
//                           $product->price * $productTmp['product_quantity'];

            $product_sum = $product->price * $productTmp['product_quantity'];

            $productToCart = [
                'id' => $productTmp['product_id'],
                'price' => $product->price,
                'sum' => $product_sum,
                'qty' => $productTmp['product_quantity'] + 0.0,
                'product_option' => isset($productTmp['product_option']) ? $productTmp['product_option'] : null
            ];

            $userCart['products'][] = $productToCart;

            $userCart['sum'] = isset($userCart['sum']) ? $userCart['sum'] : 0;
            $userCart['sum'] += $productToCart['sum'];

            Yii::$app->session->set('cart', $userCart);

            Yii::$app->session->setFlash('success_add');

            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionCartDelete($url_back = ['cart/index']) {

        if ($url = Yii::$app->request->post('url_back')) {

            $url_back[0] = $url;
        }

        if ( Yii::$app->request->isPost) {
            $userCart = Yii::$app->session->get('cart') ? Yii::$app->session->get('cart') : [];
            $product_id = Yii::$app->request->post()['prod_id'];

            $userCart['sum'] -= $userCart['products'][$product_id]['sum'] ;

            array_splice($userCart['products'], $product_id, 1);

            if(empty($userCart['products'])) {
                Yii::$app->session->set('cart', []);
                return $this->redirect($url_back);
            }

            Yii::$app->session->set('cart', $userCart);

            Yii::$app->session->setFlash('success_delete');

            return $this->redirect($url_back);
        }
    }

}