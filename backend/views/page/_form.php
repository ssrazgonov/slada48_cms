<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
//            'allowedTags' => ['p', 'h1', 'h2', 'div', 'a', ],
            'replaceDivs' => false,
            'minHeight' => 200,
            'fileUpload' => Url::to(['page/file-upload']),
            'fileDelete' => Url::to(['page/file-delete']),
            'fileManagerJson' => Url::to(['page/files-get']),
            'imageUpload' => Url::to(['page/image-upload']),
            'imageDelete' => Url::to(['page/file-delete']),
            'imageManagerJson' => Url::to(['page/images-get']),
            'plugins' => [

            ]
        ],
        'plugins' => [
            'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset',
            'filemanager' => 'vova07\imperavi\bundles\FileManagerAsset',
        ],
    ]); ?>

    <?= $form->field($model, 'parent_id')->listBox(\yii\helpers\ArrayHelper::map($categories, 'id', 'title')) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'page_slug')->textInput()->label('Ярлык') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
