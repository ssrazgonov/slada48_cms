<?php


namespace frontend\controllers;


use common\models\ProductCategory;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

class CustomController extends Controller
{
    public function actionIndex()
    {
        $custom_form = new \common\models\Custom();
        $category = ProductCategory::find()->where(['cat_slug' => 'custom'])->one();

        $categories = ProductCategory::find()->all();

        return $this->render('index', compact('custom_form', 'category', 'categories'));
    }

    public function actionUploadImg()
    {

        $file = UploadedFile::getInstanceByName('file');
        if ($file->size / 1000 > 10000) {
            return json_encode(['error' => 'Размер файла не должен превышать 10мб']);
        }
        FileHelper::createDirectory(__DIR__.'/../web/upload/tmp/');
        $file->saveAs(__DIR__.'/../web/upload/tmp/' . $file->name);
        return json_encode(['success' => $file->name]);

    }
}