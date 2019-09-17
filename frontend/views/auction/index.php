<?php
use aneeshikmat\yii2\Yii2TimerCountDown\Yii2TimerCountDown;
$this->title = Yii::$app->settings->set->title . " | " . 'Аукцион';
?>
<main class="container">
    <div class="col-lg-12">
        <h1 class="pt-5">Сладкий аукцион</h1>

        <div class="auction-product">
            <div class="row">
                <div class="col-lg-4 auction-product-img">
                    <?= \yii\bootstrap\Html::img('/upload/auction/' . $auction->auc_img) ?>
                </div>
                <div class="col-lg-8">
                    <div class="auction-product-name">
                        <h3>Название лота: <?= $auction->auc_title ?></h3>
                    </div>

                    <div class="auction-product-description mb-3">
                        <span><?= $auction->auc_text ?></span>
                    </div>

                    <div id="aucIn">


                    <?php if ($active): ?>
                    <div class="auction-time mb-3">
                        <div class="auction-time-top alert alert-dark text-center">
                            До окончания аукциона:
                        </div>
                        <div class="auction-count-down">
                            <div id="time-down-counter">
                                <span class="item-counter-down item-counter-down-0">
                                    <span class="inner-item-counter-down inner-item-counter-down-0">0</span><span class="inner-item-counter-down inner-item-counter-down-1">0</span>
                                </span><span class="item-counter-down item-counter-down-1">
                                    <span class="inner-item-counter-down inner-item-counter-down-0">0</span><span class="inner-item-counter-down inner-item-counter-down-1">0</span>
                                </span><span class="item-counter-down item-counter-down-2">
                                    <span class="inner-item-counter-down inner-item-counter-down-0">0</span><span class="inner-item-counter-down inner-item-counter-down-1">0</span>
                                </span><span class="item-counter-down item-counter-down-3">
                                    <span class="inner-item-counter-down inner-item-counter-down-0">0</span><span class="inner-item-counter-down inner-item-counter-down-1">0</span>
                                </span>
                            </div>

                            <?php
                            $callBackScript = <<< JS
$.get('/auction/get-expired', function(data) {
$('#aucIn').html(data);
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
                    </div>
                    <?php endif; ?>

                    <?php if (!$active): ?>
                        <div class="auction-time-top alert alert-dark text-center">
                            <h4 class="alert-heading">Аукцион завершен</h4>
                            <hr>
                            <p class="mb-2">Победитель аукциона: <span class="alert-link"><?= $auction->winner->username ?></span></p>
                            <p class="mb-0">Окончательная цена: <span class="alert-link"><?= $auction->winBid->bid ?> руб.</span></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($active): ?>
                    <div class="auction-price mb-3">
                        <h4>Текущая цена аукциона: <?= $auction->bid_current + $auction->bid_min ?> руб.</h4>
                    </div>

                    <div class="auction-page-controls">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <div class="mb-2">Авторизуйтесь на сайте что бы делать ставки</div>
                            <a href="<?= \yii\helpers\Url::to(['site/login', 'redirect' => 'auction/index'])?>" class="btn btn-dark">Войти</a>
                            <a href="<?= \yii\helpers\Url::to(['site/signup'])?>" class="btn btn-warning">Регистрация</a>
                        <?php else: ?>
                            <?php
                                $bid = $auction->bid_current + $auction->bid_min;
                            ?>
                            <?php $form = \yii\widgets\ActiveForm::begin(['action' => ['auction/make-bid']]); ?>
                                <?= $form->field($auctionForm, 'bid')
                                    ->textInput(['value' => $auction->bid_current + $auction->bid_min])
                                    ->label('Ваша ставка в размере от ' .
                                        ($auction->bid_current + $auction->bid_min) .
                                        ' до ' . ($auction->bid_current + $auction->bid_max)) ?>
                                <?= \yii\helpers\Html::submitButton("Сделать ставку", ['class' => 'btn btn-warning mb-3']) ?>
                                <?= $form->field($auctionForm, 'aucId')->hiddenInput(['value' => $auction->id])->label(''); ?>
                            <?php \yii\widgets\ActiveForm::end(); ?>
                            <?php if(Yii::$app->session->hasFlash('success')):?>
                                <div class="alert alert-dark">
                                    <?= Yii::$app->session->getFlash('success') ?>
                                </div>
                            <?php elseif (Yii::$app->session->hasFlash('error')): ?>
                                <div class="alert alert-danger">
                                    <?= Yii::$app->session->getFlash('error') ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="bids">

            <?php if ($auction->bids): ?>
                <h3>Текущие ставки:</h3>
                <?php foreach ($auction->bids as $bid) : ?>
                    <li class="badge-dark p-3 mb-3 list-unstyled">Участник аукциона: <?= $bid->user ? $bid->user->username : 'Гость' ?> сделал(а) ставку в размере: <?= $bid->bid ?> руб.</li>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="auc-text mb-5">
         <?= \common\models\Page::findOne(['page_slug' => 'auc-rules'])->content ?>
        </div>
    </div>
</main>