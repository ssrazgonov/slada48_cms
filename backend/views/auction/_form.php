<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Auction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auction-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'auc_img')->fileInput()->label('Загрузить изоображение') ?>
        <?= $form->field($model, 'auc_title')->textInput()->label('Название') ?>
        <?= $form->field($model, 'auc_text')->textarea()->label('Описание') ?>

        <?= $form->field($model, 'start_date')->widget(DateTimePicker::className(), [
            'pluginOptions' => [
                'autoclose'=>true,
            ]
        ])->label('Дата старта аукциона') ?>

        <?= $form->field($model, 'end_date')->widget(DateTimePicker::className(), [
            'pluginOptions' => [
                'autoclose'=>true,
            ]
        ])->label('Дата окончания аукциона') ?>

        <?= $form->field($model, 'active')->dropDownList(['1' => 'Активен', 0 => 'Не активен'])->label('Активность') ?>

        <?= $form->field($model, 'bid_step')->textInput()->label('Шаг ставки') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
