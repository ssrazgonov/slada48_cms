<?php


namespace frontend\controllers;


use common\models\Product;
use common\models\ProductCategory;
use yii\web\Controller;
use yii\data\Pagination;

class CategoryController extends Controller
{
    public function actionIndex($order = 'price') {


        $categories = ProductCategory::find()->all();

        return $this->render('index', compact('products', 'categories'));
    }

    public function actionShow($id) {

        $category = ProductCategory::find()->andWhere(['id'=> $id])->all();



        $query = Product::find()
            ->andWhere(['cat_id' => $id])
            ->andWhere(['active' => 1]);

        $pages = new Pagination(['totalCount' => $query->count()]);
        $products = $query->offset($pages->offset)
            ->limit(12)
            ->all();

        $categories = ProductCategory::find()->all();

        return $this->render('show', compact('products', 'categories', 'category', 'pages'));
    }
}