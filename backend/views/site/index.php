<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Панель управления сайтом v1.03</h1>

        <p class="lead">По вопросам обращатся на <a href="mailto:ssrazgonov@gmail.com">ssrazgonov@gmail.com</a></p>

        <p><a class="btn btn-lg btn-success">Посмотреть обучающее видео</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Управление страницами</h2>

                <p><?= \yii\helpers\Html::a('Далее', ['page/index'])?></p>
            </div>
            <div class="col-lg-6">
                <h2>Управление разделами</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
