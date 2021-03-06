<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Редактирование заказа: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Управление заказами', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование заказа';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'paymentMethods' => $paymentMethods,
        'orderStatuses' => $orderStatuses,
        'orderStatus' => $orderStatus,
        'users' => $users,
    ]) ?>

</div>
