<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">


    <div class="row">
        <div class="col-xs-3">
            <img class="img-thumbnail" src="/upload/product/<?= $model->id ?>/<?= $model->prod_img ?>" alt="">
        </div>
    </div>

    <?php $form = ActiveForm::begin(['action' => ['product/update-image', 'id' => $model->id]]); ?>
        <?= $form->field($uploadImage, 'image')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prod_img')->hiddenInput()->label('') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor_code')->textInput(['maxlength' => true]) ?>

    <?php
        $find = [];

        foreach ($filledOptions as $item) {
            if ($model->id == $item->product_id) {
                $find[] = $item->product_option_id;
            }
        }

        $product_option->product_option_id = $find;
    ?>

    <?= $form->field($product_option, 'product_option_id')->listBox(\yii\helpers\ArrayHelper::map($options, 'id', 'description'),
        ['multiple' => 'true'])
    ->label('Опции товара')?>

    <?= $form->field($model, 'cat_id')->listBox(\yii\helpers\ArrayHelper::map($categories, 'id', 'title')) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price_type_id')->listBox(\yii\helpers\ArrayHelper::map($priceType, 'id', 'title')) ?>

    <?= $form->field($model, 'description')->textarea() ?>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
