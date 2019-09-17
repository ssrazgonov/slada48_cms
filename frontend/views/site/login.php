<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<main class="container pt-5 pb-5">
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Для входа на сайт, заполните форму ниже:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('E-mail') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

                <?php if (Yii::$app->request->get('redirect')) : ?>
                    <?= $form->field($model, 'redirect')->hiddenInput(['value' => Yii::$app->request->get('redirect')])->label('') ?>
                <?php endif; ?>



                <div style="color:#999;margin:1em 0">
                    Забыли пароль ? <?= Html::a('Сбросить пароль', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</main>

