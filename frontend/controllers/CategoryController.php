<?php


namespace frontend\controllers;


use common\models\Product;
use common\models\ProductCategory;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex($order = 'price') {


        $categories = ProductCategory::find()->asArray()->all();

        foreach ($categories as &$cat) {
            $cat['prod_count'] = Product::find()->where(['cat_id' => $cat['id']])->count();
            $cat['products'] = Product::find()->where(['cat_id' => $cat['id']])->limit(4)->orderBy($order)->all();
        }

        return $this->render('index', compact('products', 'categories'));
    }

    public function actionShow($id) {

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