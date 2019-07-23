<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use frontend\models\Cart;

$userCart = Yii::$app->session->get('cart') ? Yii::$app->session->get('cart') : [];

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
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="/css/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="/modules/auction/style.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body style="background-color: #3e04331a;">
<?php $this->beginBody() ?>
<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
			<a class="navbar-brand" href="#"><img src="/img/logo.png" alt="Слада - торты на заказ в липецке" style="height: 45px"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="/?r=page/index&id=1">О фабрике</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Информация</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Торты</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Акции</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">контакты</a>
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href=""><i class="fa fa-search"></i></a>
					</li>

					<?php if(Yii::$app->user->isGuest): ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= Url::to(['site/signup']); ?>"><i class="fa fa-user-plus"></i> Регистрация</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= Url::to(['site/login']); ?>"><i class="fa fa-sign-in-alt"></i> Вход</a>
						</li>
					<?php else : ?>
						<li class="nav-item">
							<a class="nav-link" href=""><i class="far fa-user"></i> <?= Yii::$app->user->identity->username ?></a>
							<ul>
								<li><a href="<?= Url::to(['personal/index']); ?>">Личный кабинет</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link">
								<?=Html::beginForm(['/site/logout'], 'post') ?>
								<i class="fas fa-door-open"></i><?= Html::submitButton(
										'Выход',
										['class' => 'btn btn-link logout']) ?>
								<?=	Html::endForm() ?>
							</a>
							
						</li>
					<?php endif; ?>

					<li class="nav-item <?= Yii::$app->session->getFlash('success_add')? 'add_cart_anim' : ''?>">
						<a class="nav-link" href="<?= Url::to(['cart/index']) ?>"><i class="fa fa-shopping-cart"></i>&nbsp;<span class="badge badge-light"><?= Cart::getProducts($userCart, true) ?></span></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>



<?= $content ?>

<footer style="background-color: #343a40;" class="pt-4">
		<div class="container-fluid">
			<div class="row">
				<ul class="col-md-4 list-unstyled">
					<li class="p-1">
						<a class="text-white" href="#">О фабрике</a>
					</li>
					<li class="p-1">
						<a class="text-white" href="#">Информация</a>
					</li>
					<li class="p-1">
						<a class="text-white" href="#">Торты</a>
					</li>
					<li class="p-1">
						<a class="text-white" href="#">Акции</a>
					</li>
					<li class="p-1">
						<a class="text-white" href="#">контакты</a>
					</li>
				</ul>
				<div class="social col-md-4 text-white">
					<p>Следуйте за нами:</p>
					<p>Принимаем к оплате:</p>
					<img src="/img/paysystems.png" alt="">
				</div>
		<address class="col-md-4 text-white">
			<p><a href="mailto:info@slada48.ru" class="text-white">info@slada48.ru</a></p>
			<p class="phone">+7 (4742) 905-507</p>
			<p class="address">г. Липецк, ул. Космонавтов, 3б - фирменный магазин фабрики;</p>
		</address>
		</div>
		</div>
		
		
	</footer>
	<script src="/js/jquery-3.4.0.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/modules/auction/app.js"></script>
	<script src="/js/app.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>