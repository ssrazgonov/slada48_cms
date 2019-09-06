<?php

namespace backend\controllers;

use common\models\PageCategory;
use common\models\PhotosBlock;
use common\models\PhotosItems;
use common\models\Product;
use common\models\ProductOption;
use common\models\ProductOptionRel;
use common\models\ShopGoodies;
use Yii;
use common\models\Page;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Composer\Console\Application;
use Composer\Command\UpdateCommand;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * PageController implements the CRUD actions for Page model.
 */
class ImportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'view', 'delete', 'create', 'update', 'composer'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     * 3606 Детские торты
     * 3607 Праздничные торты
     * 3608 Свадебные торты
     * 3609 Корпоративные торты
     * 3695 Торты до 500 рублей
     * 3694 Топперы
     * 3692 Свечи
     */
    public function actionIndex()
    {
        $old_products = ShopGoodies::find()->where(['prov_id' => '3692'])->all();

        if (Yii::$app->request->get('start')) {
            foreach ($old_products as $old) {
                $product = new Product();

                $product->title = $old->title;
                $product->vendor_code = $old->title;
                $product->cat_id = 11;
                $product->price = $old->price;
                $product->price_type_id = 1;
                $product->description = $old->content;
                $product->prod_img = null;
                $product->active = $old->enabled;
                $product->sold = $old->sold;
                $product->views = $old->views;
                $product->lastorder = $old->lastorder;
                $product->old_id = $old->id;
                $product->sort = $old->ord;
                $product->save();

                $img = @file_get_contents('http://www.slada48.ru/' . $old->image);

                if (!$img) {
                    $img = @file_get_contents('http://www.slada48.ru/' . str_replace(['.jpg', '.png'], '', $old->image) . '&asp&x=mn&w=484&h=500&m=o&q=100&c=ffffff&bsp&.jpg');
                }

                if (!$img) {
                    $img = @file_get_contents('http://www.slada48.ru/' . str_replace(['.jpg', '.png'], '', $old->image) . '&asp&x=mn&w=484&h=500&m=&q=100&bsp&.jpg');
                }

                if ($img) {
                    $dir = __DIR__."/../../frontend/web/upload/product/{$product->id}";
                    FileHelper::createDirectory($dir);

                    file_put_contents($dir . "/{$product->title}.jpg", $img);

                    $product->prod_img = $product->title . ".jpg";
                    $product->save();
                }

                $photoBlock = PhotosBlock::find()->where(['id' => $product->old_id + 100000])->one();
                $photoItems = PhotosItems::find()->where(['prov_id' => $photoBlock->id])->all();

                $optionsTrueIds = [];

                foreach ($photoItems as $photoItem) {
                    preg_match('/[0-9]+/', $photoItem->title, $matches, PREG_OFFSET_CAPTURE);
                    $optionsTrueId = substr($matches[0][0], -1, 1);
                    $optionsTrueIds[] = $optionsTrueId;
                }

                foreach ($optionsTrueIds as $optionsTrueId) {
                    $productOption = ProductOption::find()->where(['vendor_code' => $optionsTrueId])->one();
                    $productOptionRel = new ProductOptionRel();
                    $productOptionRel->product_id = $product->id;
                    $productOptionRel->product_option_id = $productOption->id;
                    $productOptionRel->save();
                }

            }
        }

        return $this->render('index', compact('old_products'));
    }

    public function actionComposer()
    {
        require '../../vendor/autoload.php'; // require composer dependencies

        //Use the Composer classes


        // change out of the webroot so that the vendors file is not created in
        // a place that will be visible to the intahwebz
        chdir('../../');
        var_dump(getcwd());

        //Create the commands
        $input = new ArrayInput(array('command' => 'update'));

        //Create the application and run it with the commands
        $application = new Application();
        $application->run($input);
    }


}
