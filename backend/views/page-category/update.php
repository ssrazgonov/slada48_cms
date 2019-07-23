<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PageCategory */

$this->title = 'Редактирование раздела сайта: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Разделы сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
