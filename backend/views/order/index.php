<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление заказами';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\CheckboxColumn'],
            'id',
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user->email;
                }
            ],
            [
                'attribute' => 'payment_method',
                'format' => 'html',
                'value' => function ($data) {
                    return $data->paymentMethod->title;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($data) {
                    return "<span style='color: {$data->orderStatus->color}'>{$data->orderStatus->name}</span>";
                }
            ],
            'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
