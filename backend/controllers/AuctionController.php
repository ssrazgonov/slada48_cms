<?php

namespace backend\controllers;

use backend\models\UploadImage;
use common\models\Product;
use common\models\ProductOption;
use Yii;
use common\models\Auction;
use common\models\AuctionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AuctionController implements the CRUD actions for Auction model.
 */
class AuctionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Auction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuctionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Auction model.
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
     * Creates a new Auction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $uploadImage = new UploadImage();
            $uploadImage->image = UploadedFile::getInstance($model, 'auc_img');
            $img = $uploadImage->upload('auction/');

            if($img) {
                $model->auc_img = $img;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Auction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $products = Product::find()->where(['active' => 1])->asArray()->all();
        $product_options = ProductOption::find()->asArray()->all();
        $uploadImage = new UploadImage();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'products' => $products,
            'product_options' => $product_options,
            'uploadImage' => $uploadImage
        ]);
    }


    public function actionUpdateImage($id)
    {
        $uploadImage = new UploadImage();
        $model = $this->findModel($id);

        if ($uploadImage->load(Yii::$app->request->post())) {
            $uploadImage->image = UploadedFile::getInstance($uploadImage, 'image');

            if ($model->auc_img = $uploadImage->upload("auction/")) {
                $model->save();
            }
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->redirect(['update', 'id' => $model->id]);
    }


    /**
     * Deletes an existing Auction model.
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
     * Finds the Auction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
