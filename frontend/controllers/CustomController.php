<?php


namespace frontend\controllers;


use common\models\Order;
use common\models\OrderProduct;
use common\models\Product;
use common\models\ProductCategory;
use frontend\models\Custom;
use Yii;
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
            $product->title = $custom_form->text;
            $product->cat_id = $category->id;
            $product->prod_img = null;
            $product->description = $custom_form->comment;
            $product->price_type_id = 1;
            $product->price = Yii::$app->settings->set->custom_price;
            $product->save();

            if (\Yii::$app->session->has('img')) {
                $img = \Yii::$app->session->get('img');

                if (file_exists(__DIR__.'/../web/upload/tmp/user/' . \Yii::$app->user->id . '/custom_cake/' .$img)) {
                    FileHelper::createDirectory(__DIR__.'/../web/upload/product/' . $product->id);
                    rename(__DIR__.'/../web/upload/tmp/user/' . \Yii::$app->user->id . '/custom_cake/' .$img , __DIR__.'/../web/upload/product/' . $product->id . '/' .$img);
                } else {
                    $img = null;
                }


            } else {
                $img = null;
            }

            $product->prod_img = $img;
            $product->save();

            $order = new Order();

            $order->user_id = Yii::$app->user->id;
            $order->amount = $custom_form->weight * $product->price;
            $order->payment_method = $custom_form->payment;
            $order->note = "Поздравительная надпись {$custom_form->text}, комментарий к заказу {$custom_form->comment}, дата выдачи: {$custom_form->datetime}";

            if ($order->save()) {

                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $product->id;
                $orderProduct->quantity = $custom_form->weight;
                $orderProduct->price = $product->price;
                $orderProduct->product_option = null;
                $orderProduct->sum = $product->price * $custom_form->weight;

                if(!$orderProduct->save()) {
                    Yii::$app->session->setFlash('error');
                    $orderProducts = OrderProduct::find()->where(['order_id' => $order->id])->all();
                    $orderProducts->delete();
                    $order->delete();
                    return $this->redirect(['custom/index']);
                }


            } else {
                Yii::$app->session->setFlash('error');
                return $this->redirect(['custom/index']);
            }

            return $this->redirect(['personal/order', 'id' => $order->id]);



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
        \Yii::$app->session->set('img', $file->name);
        return json_encode(['success' => '/upload/tmp/user/'  . \Yii::$app->user->id . '/custom_cake/' . $file->name]);

    }

}