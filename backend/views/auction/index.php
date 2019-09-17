<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AuctionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auctions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Auction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'start_date',
            'end_date',
            'active',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
