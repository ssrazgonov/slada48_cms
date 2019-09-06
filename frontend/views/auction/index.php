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
                        <h4>Текущая цена аукциона: <?= $auction->bid_current + $auction->bid_step ?> руб.</h4>
                    </div>

                    <div class="auction-page-controls">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <div class="mb-2">Авторизуйтесь на сайте что бы делать ставки</div>
                            <a href="<?= \yii\helpers\Url::to(['site/login'])?>" class="btn btn-dark">Войти</a>
                            <a href="<?= \yii\helpers\Url::to(['site/register'])?>" class="btn btn-warning">Регистрация</a>
                        <?php else: ?>
                            <?php
                                $bid = $auction->bid_current + $auction->bid_step;
                            ?>
                            <?php $form = \yii\widgets\ActiveForm::begin(['action' => ['auction/make-bid']]); ?>
                                <?= \yii\helpers\Html::submitButton("Сделать ставку {$bid} руб.", ['class' => 'btn btn-warning mb-3']) ?>
                                <?= $form->field($auction, 'id')->hiddenInput()->label(''); ?>
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
            <?foreach ($auction->bids as $bid) : ?>
                <li class="badge-dark p-3 mb-3 list-unstyled">Участник аукциона: <?= $bid->user->username ?> сделал(а) ставку в размере: <?= $bid->bid ?> руб.</li>
            <? endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="auc-text mb-5">
            <p>&nbsp;</p>
            <h2><strong>Условия участия&nbsp;</strong></h2>
            <div>&nbsp;</div>
            <p>Для участия&nbsp;в аукционе Вам необходимо&nbsp;<a href="http://www.slada48.ru/join?r=auc">зарегистрироваться на нашем сайте</a>&nbsp;или<a href="http://www.slada48.ru/login?r=auc">войти на сайт со своим паролем</a>, если вы уже зарегистрированы.</p>
            <p>Как&nbsp;делать ставки</p>
            <p>После&nbsp;регистрации на сайте делаем ставки с учетом шага аукциона (5 руб.): 10; 15; 20 и т.д... Если после вас сделает ставку другой покупатель, вам придет уведомление по электронной почте. Если лот&nbsp; вас все еще интересует (уже по более высокой цене) сделайте еще одну ставку.</p>
            <p>* Обращайте внимание на правильно выставленный часовой пояс у вашего ПК.</p>
            <p><strong>Как получить товар</strong></p>
            <p>Если вы стали победителем торгов вам придет уведомление с контактами продавца. Звоните и договаривайтесь о времени свершения сделки в течении трех рабочих дней.</p>
            <div>&nbsp;</div>
            <p><strong>Пункты выдачи: Фирменные магазины "ТД Слада"</strong></p>
            <div>&nbsp;</div>
            <div>г. Липецк, ул. Космонавтов, 3б, фирменный магазин фабрики</div>
            <div>г.Липецк, Октябрьский рынок, торговая точка ООО "ТД Слада"</div>
            <div>г. Липецк, Плехановский Пассаж,&nbsp;торговая точка ООО "ТД Слада"</div>
            <div>г. Грязи, ул. Правды, 72,&nbsp;торговая точка ООО "ТД Слада"</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div><strong><a href="http://www.slada48.ru/auction/wienners">Победители аукциона</a></strong></div>
        </div>
    </div>
</main>