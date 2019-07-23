<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-category-view">

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
            [
                'attribute' => 'parent_id',
                'label' => 'Родительская категория',
                'value' => function($data){
                    return $data->category ? $data->category->title : 'НЕТ';}
            ],
            'cat_img',
            [
                'attribute' => 'cat_img',
                'format' => 'html',
                'value' => function ($data) {
                    return "<img height='100px' src='/upload/category/{$data->id}/{$data->cat_img}'>";
                }
            ],
            'description:ntext',
            'cat_slug',
        ],
    ]) ?>

</div>
