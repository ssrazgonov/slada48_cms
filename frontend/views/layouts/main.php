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
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="modules/auction/style.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="background-color: #3e04331a;">
<?php $this->beginBody() ?>
<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
			<a class="navbar-brand" href="#"><img src="img/logo.png" alt="Слада - торты на заказ в липецке" style="height: 45px"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">О фабрике</a>
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

					<li class="nav-item">
						<a class="nav-link" href=""><i class="fa fa-shopping-cart"></i>&nbsp;<span class="badge badge-light">10</span></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="container-fluid pt-5 pb-5" style="background: url(img/bg.png) center; background-size: cover; background-color: #ce39b21a;">
		<div class="row">
			<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
				<h1 class="text-white text-center pt-5">Делайте свою жизнь сладкой! Торты на заказ в Липецке</h1>
				<h2 class="text-white text-center pt-5">Потому что мы с вами!</h2>
				<div class="text-center p-5"><a href="" class="btn btn-success">Действующие Акции</a></div>
			</div>
			<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
				<div class="card bg-light">
					<h5 class="card-header text-uppercase">Сладкий аукцион</h5>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
								<img src="img/auc.jpg" alt="" class="w-100">
								<p class="text-center text-success">Ставок: 4</p>
							</div>
							<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
								<h5 class="card-title">До окончания аукциона:</h5>
								<div class="numbers row">
									<div class="col-md-3 text-center display-6">2</div>
									<div class="col-md-3 text-center display-6">5</div>
									<div class="col-md-3 text-center display-6">25</div>
									<div class="col-md-3 text-center display-6">55</div>
								</div>
								<div class="text row">
									<div class="col-md-3 text-center pb-3">Дней</div>
									<div class="col-md-3 text-center pb-3">Часов</div>
									<div class="col-md-3 text-center pb-3">Минут</div>
									<div class="col-md-3 text-center pb-3">Секунд</div>
								</div>
								<p class="card-text">Купить торт за: <a class="text-success" href="">25 rub</a></p>

								<a href="#" class="btn btn-success mt-2">участвовать</a>
								<a href="#" class="btn btn-primary mt-2">Условия участия</a>
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="auction">
		<div class="auction__header">
			<h3 class="auction__title">СЛАДКИЙ АУКЦИОН</h3>
		</div>

		<div class="auction__body">
			<div class="auction__part auction__part_left">
				<div class="auction__item">
					<img src="modules/auction/auction__img.jpg" class="auction__img">
				</div>
				<div class="auction__rate"></div>
			</div>

			<div class="auction__part auction__part_right">
				<div class="timer">
					<div class="timer__title">До окончания аукциона:</div>
					<div class="timer__counter">
						<div class="timer__item timer__days"></div>
						<div class="timer__item timer__hours"></div>
						<div class="timer__item timer__minutes"></div>
						<div class="timer__item timer__seconds"></div>
					</div>
				</div>
				
				<div class="price"></div>

				<div class="bet">
					<button class="bet_button">Сделать ставку</button>
				</div>
			</div>
		</div>
	</div> -->
			</div>
		</div>
	</div>

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
					<img src="img/paysystems.png" alt="">
				</div>
		<address class="col-md-4 text-white">
			<p><a href="mailto:info@slada48.ru" class="text-white">info@slada48.ru</a></p>
			<p class="phone">+7 (4742) 905-507</p>
			<p class="address">г. Липецк, ул. Космонавтов, 3б - фирменный магазин фабрики;</p>
		</address>
		</div>
		</div>
		
		
	</footer>
	<script src="js/jquery-3.4.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="modules/auction/app.js"></script>
	<script src="js/app.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>