<?php


namespace frontend\controllers;


use common\models\Page;
use common\models\PageCategory;
use yii\web\Controller;
use Yii;

class PageController extends Controller
{
    public function actionIndex($id)
    {
        $page =
            (Page::find()
                ->where(['id' => $id])
                ->one())
                            ??
            (Page::find()
                ->where(['page_slug' => $id])
                ->one());

        if (!$page) {
            return $this->goHome();
        }

        $category = PageCategory::find()
            ->where(['id' => $page->parent_id])
            ->one();

        $pagesInCategory = Page::find()
            ->where(['parent_id' => $page->parent_id])
            ->all();



        return $this->render('index', compact('page', 'pagesInCategory', 'category'));
    }
}