<?php

namespace backend\controllers;

use common\models\Category;
use common\models\PriceType;
use common\models\ProductCategory;
use common\models\ProductOption;
use common\models\ProductOptionRel;
use Yii;
use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\UploadImage;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'actions' => ['index', 'view', 'delete', 'update', 'create', 'update-image'],
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $categories = ProductCategory::find()->asArray()->all();
        $priceType = PriceType::find()->asArray()->all();
        $options = ProductOption::find()->asArray()->all();
        $product_option = new ProductOptionRel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $uploadImage = new UploadImage();
            $uploadImage->image = UploadedFile::getInstance($model, 'prod_img');

            $model->prod_img = $uploadImage->upload("product/$model->id/");

            if ($model->save()) {

                if (isset(Yii::$app->request->post()['ProductOptionRel']) && !empty(Yii::$app->request->post()['ProductOptionRel']['product_option_id'])) {

                    $productOptionRel['ProductOptionRel'] = Yii::$app->request->post()['ProductOptionRel'];
                    $productOptionRel['ProductOptionRel']['product_id'] = $model->id;

                    foreach ($productOptionRel['ProductOptionRel']['product_option_id'] as $option) {
                        $model_option = new ProductOptionRel();
                        $model_option->product_option_id = $option;
                        $model_option->product_id = $model->id;
                        $model_option->save();
                    }

                }


                return $this->redirect(['view', 'id' => $model->id]);
            }



        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
            'priceType' => $priceType,
            'options' => $options,
            'product_option' => $product_option,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    private function clearOptions($id) {
        $model = ProductOptionRel::find()->where(['product_id' => $id])->all();

        foreach ($model as $item) {
            $item->delete();
        }
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadImage = new UploadImage();
        $categories = ProductCategory::find()->asArray()->all();
        $priceType = PriceType::find()->asArray()->all();
        $options = ProductOption::find()->asArray()->all();
        $product_option = new ProductOptionRel();

        $filledOptions = ProductOptionRel::find()->where(['product_id' => $model->id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $this->clearOptions($id);

            if (isset(Yii::$app->request->post()['ProductOptionRel']) && !empty(Yii::$app->request->post()['ProductOptionRel']['product_option_id'])) {

                $productOptionRel['ProductOptionRel'] = Yii::$app->request->post()['ProductOptionRel'];
                $productOptionRel['ProductOptionRel']['product_id'] = $model->id;

                foreach ($productOptionRel['ProductOptionRel']['product_option_id'] as $option) {
                    $model_option = new ProductOptionRel();
                    $model_option->product_option_id = $option;
                    $model_option->product_id = $model->id;
                    $model_option->save();
                }

            }

            return $this->redirect(['view', 'id' => $model->id]);

        }

        return $this->render('update', [
            'model' => $model,
            'uploadImage' => $uploadImage,
            'categories' => $categories,
            'priceType' => $priceType,
            'options' => $options,
            'product_option' => $product_option,
            'filledOptions' => $filledOptions
        ]);
    }

    public function actionUpdateImage($id)
    {
        $uploadImage = new UploadImage();
        $model = $this->findModel($id);

        if ($uploadImage->load(Yii::$app->request->post())) {
            $uploadImage->image = UploadedFile::getInstance($uploadImage, 'image');

            if ($model->prod_img = $uploadImage->upload("product/$model->id/")) {
                $model->save();
            }
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->redirect(['update', 'id' => $model->id]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
