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

                        <?php
                            $colors = [
                                1 => "#ffc107", 2 => '#1e7e34', 3 => 'yellow', 4 => 'gray'
                            ];
                         ?>
                        <td><span style="background-color: <?= $colors[$order->orderStatus->code]?>"> <?= $order->orderStatus->name ?></span></td>
                        <td class="text-center">
                            <a href="<?= Url::to(['personal/order', 'id' => $order->id])?>" class="btn btn-success mb-2 personal-btn">Подробнее</a>
                            <?php if ($order->paymentMethod->code == 'sber' && $order->status == 1) :?>
                                <?= \yii\helpers\Html::a('Оплатить', ['/sberbank/default/create', 'id' => $invoices[$order->id]->id /* id инвойса */], ['class' => 'btn btn-warning personal-btn']) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    
                <?php endforeach; ?>
                </table>

            <?php endif; ?>

        </div>
    </div>
</main>