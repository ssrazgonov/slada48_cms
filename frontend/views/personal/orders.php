<?php 
use yii\helpers\Url;
$this->title = Yii::$app->settings->set->title . " | " . 'Список заказов';
?>

<main class="container">
    <div class="row">
        <div class="col-md-4">
            <h1 class="mt-4">Личный кабинет</h1>
            <div class="card mb-2 mt-5">

                <?= $this->render('_left') ?>

            </div>
        </div>
        <div class="col-lg-8">

            <div class="alert alert-light order-step mt-5 mb-5" role="alert">
                <h2>Ваш список заказов <?= empty($orders )? 'пуст' : '' ?></h2>
            </div>

            <?php if (!empty($orders)) : ?>
                <table class="table table-bordered table-dark mb-5">
                    <tr>
                        <th>Номер заказа</th>
                        <th>Сумма заказа</th>
                        <th>Дата заказа</th>
                        <th>Метод оплаты заказа</th>
                        <th>Статус заказа</th>
                        <th></th>
                    </tr>
                <?php foreach ($orders as $order): ?>


                    <tr>
                        <td><?= $order->id ?></td>
                        <td><?= $order->amount ?> руб.</td>
                        <td><?= $order->created_at ?></td>
                        <td><?= $order->paymentMethod->title ?></td>
                        <td><?= $order->orderStatus->name ?></td>
                        <td class="text-center">
                            <a href="<?= Url::to(['personal/order', 'id' => $order->id])?>" class="btn btn-success mb-2">Перейти</a>
                            <?php if ($order->paymentMethod->code == 'sber') : ?>
                                <a href="<?= Url::to(['order/pay', 'id' => $order->id])?>" class="btn btn-warning">Оплатить</a>
                            <?php endif; ?>
                        </td>
                    </tr>


<!--                    <li><a href="--><?//= Url::to(['personal/order', 'id' => $order->id])?><!--" >  Заказ номер: --><?//= $order->id ?><!-- На сумму:--><?//= $order->amount ?><!-- Время заказа: --><?//= $order->created_at ?><!--</a> </li>-->
                    
                <?php endforeach; ?>
                </table>

            <?php endif; ?>

        </div>
    </div>
</main>