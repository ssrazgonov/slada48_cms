<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use vova07\imperavi\bundles\ImageManagerAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Отображение меню</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Панель управления</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Панель управления</a></li>
                <li><a href="#">Настройки сайта</a></li>
                <li><a href="#">Профиль администратора</a></li>
                <li><a href="#">Помощь</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Поиск...">
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <?php if (!Yii::$app->user->isGuest) : ?>
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'order/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['order/index']) ?>">Управление заказами</a></li>
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'user/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['user/index']) ?>">Управление покупателями</a></li>

            </ul>
            <ul class="nav nav-sidebar">
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'product-category/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['product-category/index']) ?>">Категории товаров</a></li>
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'product/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['product/index']) ?>">Товары</a></li>
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'product-option/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['product-option/index']) ?>">Опции</a></li>

            </ul>
            <ul class="nav nav-sidebar">
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'page-category/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['page-category/index']) ?>">Разделы</a></li>
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'page/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['page/index']) ?>">Страницы сайта</a></li>
            </ul>

            <ul class="nav nav-sidebar">
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'menu/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['menu/index']) ?>">Меню</a></li>
            </ul>

            <ul class="nav nav-sidebar">
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'auction/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['auction/index']) ?>">Аукцион</a></li>
                <li class="<?= Yii::$app->getRequest()->pathInfo == 'bid/index' ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['bid/index']) ?>">Ставки</a></li>
            </ul>
        </div>

        <?php endif; ?>

        <div class="<?= Yii::$app->user->isGuest ? 'col-xs-12' : 'col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main' ?>">
            <?= $content ?>
        </div>

    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
