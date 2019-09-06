<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = 'Редактирование меню: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$menu_items_array = ArrayHelper::toArray($menu_items);
$menu_items_array[] = ['id' => 0, 'name' => 'НЕТ'];
?>
<div class="menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <h2>Элементы меню <?= $model->name ?></h2>
    <?php foreach ($menu_items as $item): ?>
        <?php $form = ActiveForm::begin(['action' => ['menu/update-item', 'id' =>$item->id], 'options' => [
            'class' => 'form-inline',
            'style' => 'display:inline-block'
        ]]); ?>
        <?= $form->field($item, 'name', ['labelOptions' => [ 'class' => 'your_custom_class_name' ]])->textInput(['maxlength' => true])->label('') ?>
        <?= $form->field($item, 'url')->textInput(['maxlength' => true])->label('') ?>
        <?= $form->field($item, 'parent_id')->dropDownList(ArrayHelper::map($menu_items_array, 'id', 'name'))->label('') ?>
        <?= $form->field($item, 'menu_id')->hiddenInput()->label('') ?>
        <div class="form-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-saved"></span>', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php $form = ActiveForm::begin(['action' => ['menu/delete-item', 'id' =>$item->id],'options' => [
            'class' => 'form-inline',
            'style' => 'display:inline-block'
        ]]); ?>
        <div class="form-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-remove"></span>', ['class' => 'btn btn-danger']) ?>
        </div>
        <?php ActiveForm::end(); ?>

        <div></div>


    <?php endforeach; ?>

    <h2>Добавить новый элемент меню <?= $model->name ?></h2>

    <?php
        $form = ActiveForm::begin(['action' => ['menu/add-item'],
            'options' => [
                  'class' => 'form-inline'
            ]
        ]);
    ?>

        <?= $form->field($menu_item, 'name')->textInput(['class' => 'form-control', 'placeholder' => 'Название'])->label('') ?>
        <?= $form->field($menu_item, 'url')->textInput(['class' => 'form-control', 'placeholder' => 'Ссылка'])->label('') ?>
        <?= $form->field($menu_item, 'parent_id')->dropDownList(ArrayHelper::map($menu_items_array, 'id', 'name'))->label('') ?>
        <?= $form->field($menu_item, 'menu_id')->hiddenInput(['value' => $model->id])->label('') ?>

        <div class="form-group">
            <?= Html::submitButton('+', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>



</div>