<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'vendor_code',
            [
                'attribute' => 'cat_id',
                'value' => function($data){
                    return $data->category ? $data->category->title : 'НЕТ';}
            ],
            'price',
            //'price_type_id',
            //'description',
            //'prod_img',
            //'prod_slug',
            //'qty_type',
            //'min',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
