<?php


namespace frontend\controllers;


use common\models\Product;
use common\models\ProductCategory;
use common\models\ProductOption;
use common\models\QtyPreset;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex($id) {

        $product = Product::find()->where(['id' => $id])->limit(1)->one();

        $category = ProductCategory::find()->where(['id' => $product->cat_id])->limit(1)->one();

        $categories = ProductCategory::find()->all();

        $products = Product::find()
            ->where(['cat_id' => $product->cat_id])
            ->all();

        return $this->render('index', compact('products', 'product', 'category', 'categories'));
    }
}