<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Auction */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Auctions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'start_date',
            'end_date',
            'active',
            [
                    'attribute' => 'winner_bid_id',
                    'label' => 'Победитель',
                    'format' => 'html',
                    'value' => function($data) {

                        return !empty($data->winner->id) ? "<a href='/admin/user/view?id={$data->winner->id}'>{$data->winner->email}</a>" : 'НЕТ';
                    }

            ],
            'bid_current',
        ],
    ]) ?>

</div>
