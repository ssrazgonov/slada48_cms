<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Auction */

$this->title = 'Редактирование аукциона: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Auctions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="auction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'uploadImage' => $uploadImage
    ]) ?>

</div>
