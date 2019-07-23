<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prod_img')->fileInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->listBox(\yii\helpers\ArrayHelper::map($categories, 'id', 'title')) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price_type_id')->listBox(\yii\helpers\ArrayHelper::map($priceType, 'id', 'title')) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
