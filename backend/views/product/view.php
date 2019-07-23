<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'vendor_code',
            [
                'attribute' => 'cat_id',
                'value' => function($data){
                    return $data->category ? $data->category->title : 'НЕТ';}
            ],
            'price',
            [
                'attribute' => 'price_type_id',
                'value' => function($data){
                    return $data->priceType->title;}
            ],
            'description',
            [
                'attribute' => 'prod_img',
                'format' => 'html',
                'value' => function($data){
                    return "<img height=\"100px\" src=\"/upload/product/$data->id/$data->prod_img\">";}
            ],
            'min',
        ],
    ]) ?>

</div>
