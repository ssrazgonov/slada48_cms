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

    public function actionIndex1($order = 'price') {


        $categories = ProductCategory::find()->asArray()->all();

        foreach ($categories as &$cat) {
            $cat['prod_count'] = Product::find()->where(['cat_id' => $cat['id']])->count();
            $cat['products'] = Product::find()->where(['cat_id' => $cat['id']])->limit(4)->orderBy($order)->all();
        }

        return $this->render('index', compact('products', 'categories'));
    }

    public function actionShow1($id) {

        $category = ProductCategory::find()->where(['id'=> $id])->all();

        $products = Product::find()
            ->where(['cat_id' => $id])
            ->all();

        $categories = ProductCategory::find()->asArray()->all();

        foreach ($categories as &$cat) {
            $cat['prod_count'] = Product::find()->where(['cat_id' => $cat['id']])->count();
        }

        return $this->render('show', compact('products', 'categories', 'category'));
    }
}