<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->settings->set->title . " | " . 'Личный кабинет';
?>


<div class="container">
    <h1 class="mt-4">Личный кабинет</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-2">
                <?= $this->render('_left') ?>
            </div>
        </div>

        <div class="col-md-8">
            <h2></h2>
        </div>

    </div>
</div>
