<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PageCategory */

$this->title = 'Создать раздел';
$this->params['breadcrumbs'][] = ['label' => 'Разделы сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
