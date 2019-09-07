<?php


namespace frontend\controllers;


use common\models\Product;
use common\models\ProductCategory;
use frontend\models\Custom;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

class CustomController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'upload-img'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $custom_form = new Custom();
        $category = ProductCategory::find()->where(['cat_slug' => 'custom'])->one();
        $categories = ProductCategory::find()->all();

        if ($custom_form->load(\Yii::$app->request->post())) {
            $product = new Product();
            $product->$title = $custom_form->text;
            $product->save();
        }

        return $this->render('index', compact('custom_form', 'category', 'categories'));
    }

    public function actionUploadImg()
    {

        $file = UploadedFile::getInstanceByName('file');
        if ($file->size / 1000 > 10000) {
            return json_encode(['error' => 'Размер файла не должен превышать 10мб']);
        }
        FileHelper::createDirectory(__DIR__.'/../web/upload/tmp/user/' . \Yii::$app->user->id . '/custom_cake/');
        $file->saveAs(__DIR__.'/../web/upload/tmp/user/'  . \Yii::$app->user->id . '/custom_cake/' . $file->name);
        return json_encode(['success' => $file->name]);

    }

    public function actionCreate()
    {
        $product = new Product();

    }
}