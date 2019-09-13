<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<main class="container pt-5 pb-5">
    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Пожалуйста заполните поля для регистрации на сайте:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Ваше имя') ?>

                    <?= $form->field($model, 'email')->label('E-mail') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

                    <?= $form->field($model, 'phone')->label('Ваш телефонный номер') ?>

                    <?= $form->field($model, 'policy')->checkbox(['value'=>1, 'uncheckValue'=>0])->label('Даю согласие на обработку моих персональных данных. <a href="#" data-toggle="modal" data-target="#exampleModal">Политика конфиденциальности</a>'); ?>

                    <div class="form-group">
                        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Политика конфиденциальности</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $policy->content ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>


</main>
