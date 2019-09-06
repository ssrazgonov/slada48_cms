<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->settings->set->title . ' | ' . $site_inform->title;

use aneeshikmat\yii2\Yii2TimerCountDown\Yii2TimerCountDown; ?>

<div class="container-fluid pt-5 pb-5" style="background: url(img/bg.png) center; background-size: cover; background-color: #ce39b21a;">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
            <h1 class="text-white text-center pt-5">Делайте свою жизнь сладкой! Торты на заказ в Липецке</h1>
            <h2 class="text-white text-center pt-5">Потому что мы с вами!</h2>
            <div class="text-center p-5"><a href="<?= \yii\helpers\Url::to(['category/show', 'id' => 8]) ?>" class="btn btn-success">Действующие Акции</a></div>
        </div>

        <?php if (!empty($auction)) : ?>
        <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">

            <div class="card bg-light">
                <h5 class="card-header text-uppercase">Сладкий аукцион: <?= $auction->auc_title ?></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                            <img class="img-responsive img-fluid" src="/upload/auction/<?=$auction->auc_img?>" alt="">
                            <p class="text-center text-success mt-2">Ставок: <?= count($auction->bids) ?></p>
                        </div>
                        <div id="aucOnMain"class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                            <?php if (!$active): ?>
                                <div class="auction-time-top alert alert-success text-center">
                                    <h4 class="alert-heading">Аукцион завершен</h4>
                                    <hr>
                                    <?php if($auction->winner): ?>
                                        <p class="mb-2">Победитель аукциона: <span class="alert-link"><?= $auction->winner->username ?></span></p>
                                        <p class="mb-0">Окончательная цена: <span class="alert-link"><?= $auction->winBid->bid ?> руб.</span></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($active): ?>
                            <h5 class="card-title">До окончания аукциона:</h5>
                            <div class="numbers row">
                                <div id="time-down-counter" class="onMain">
                                    <span class="item-counter-down item-counter-down-0">
                                        <span class="inner-item-counter-down inner-item-counter-down-0">0</span><span class="inner-item-counter-down inner-item-counter-down-1">0</span>
                                    </span><span class="item-counter-down item-counter-down-1">
                                        <span class="inner-item-counter-down inner-item-counter-down-0">0</span><span class="inner-item-counter-down inner-item-counter-down-1">0</span>
                                    </span><span class="item-counter-down item-counter-down-2">
                                        <span class="inner-item-counter-down inner-item-counter-down-0">0</span><span class="inner-item-counter-down inner-item-counter-down-1">0</span>
                                    </span><span class="item-counter-down item-counter-down-3">
                                        <span class="inner-item-counter-down inner-item-counter-down-0">0</span><span class="inner-item-counter-down inner-item-counter-down-1">0</span>
                                    </span></div>
<?php
$callBackScript = <<< JS
$.get('/auction/get-expired', function(data) {
$('#aucOnMain').html(data);
});
JS;
?>
                                <?= Yii2TimerCountDown::widget([
                                    'countDownDate' => strtotime($auction->end_date) * 1000,
                                    'countDownResSperator' => '',
                                    'templateStyle' => 1,
                                    'countDownOver' => '',
                                    'callBack' => $callBackScript
                                ]) ?>
                            </div>
                            <p class="card-text mt-2">Купить торт за: <a class="text-success" href=""><?= $auction->bid_current + $auction->bid_step ?> руб.</a></p>

                            <a href="<?= \yii\helpers\Url::to(['auction/index']) ?>" class="btn btn-success mt-2">участвовать</a>
                            <a href="#" class="btn btn-primary mt-2">Условия участия</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
	
	<main class="container">
		<div class="row pb-5 categoryOnMain">

            <?php foreach ($categories as $category): ?>

            <?php if ($category->cat_slug == 'custom') { continue; } ?>
			<section class="col-lg-3 col-sm-6 pt-5">
				<a class="card cakes" href="<?= \yii\helpers\Url::to(['category/show', 'id' => $category->id])?>">
					<img class="card-img-top border-bottom p-3" src="/upload/category/<?=$category->id ?>/<?=$category->cat_img ?>" alt="<?=$category->title ?>">
					<div class="card-body">
                        <h5 class="card-title text-center text-success"><?=$category->title ?> <span class="badge badge-primary badge-pill"><?=$category->productCount ?></span></h5>
					</div>
				</a>
			</section>
            <?php endforeach; ?>
		</div>
		<article class="row pb-5">
            <?= $site_inform->content ?>
        </article>
		<div class="order-by-photo pt-4 pb-5">
			<h2 class="text-center pb-4">Заказ торта по вашему фото</h2>
			<div class="row">
				<div class="container-fluid">
					<div id="carousel-example" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner row w-100 mx-auto" role="listbox">
							<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
								<a href=""><img src="img/1.jpg" class="img-fluid mx-auto d-block" alt="img1"></a>
							</div>
							<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
								<a href=""><img src="img/2.jpg" class="img-fluid mx-auto d-block" alt="img2"></a>
							</div>
							<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
								<a href=""><img src="img/3.jpg" class="img-fluid mx-auto d-block" alt="img3"></a>
							</div>
							<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
								<a href=""><img src="img/4.jpg" class="img-fluid mx-auto d-block" alt="img4"></a>
							</div>
							<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
								<a href=""><img src="img/5.jpg" class="img-fluid mx-auto d-block" alt="img5"></a>
							</div>
							<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
								<a href=""><img src="img/6.jpg" class="img-fluid mx-auto d-block" alt="img6"></a>
							</div>
							<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
								<a href=""><img src="img/7.jpg" class="img-fluid mx-auto d-block" alt="img7"></a>
							</div>
							<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
								<a href=""><img src="img/8.jpg" class="img-fluid mx-auto d-block" alt="img8"></a>
							</div>
						</div>
						<a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
			<div class="text-center pt-5">
				<a href="<?= \yii\helpers\Url::to(['custom/index']) ?>" class="btn btn-lg btn-success">Заказать торт</a>
			</div>
		</div>

		
	</main>
	
</body>
</html>