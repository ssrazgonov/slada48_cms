<?php
$this->title = Yii::$app->settings->set->title . " | " . 'Просмотр заказа';
?>

<main class="container">
    <div class="row">
        <div class="col-md-4">
            <h1 class="mt-4">Личный кабинет</h1>
            <div class="card mb-2 mb-2 mt-5">
                <?= $this->render('_left') ?>
            </div>
        </div>
        <div class="col-lg-8 mt-4">
            <h2>
                Заказ номер: <?= $order->id ?>
            </h2>

            <div class="alert alert-light order-step mt-5 mb-3" role="alert">
                <h3>Состав заказа:</h3>
            </div>

            <table class="cart-table mb-2 mt-5">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Изоображение</th>
                    <th scope="col">Наименование товара</th>
                    <th scope="col">Опции / Начинка</th>
                    <th scope="col">Кол-во кг. / штук</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Сумма</th>
                </tr>
                </thead>
                <tbody>

                <?php $sum = 0; $i = 1; foreach ($order->orderProduct as $product): ?>
                    <tr>
                        <th><?= $i++ ?></th>
                        <td><img src="/upload/product/<?=$product->product->id?>/<?= $product->product['prod_img'] ?>" alt="<?= $product->product['title'] ? $product->product['title'] : $product->product['vendor_code'] ?>" class="cart-img"></td>
                        <td><?= $product->product['vendor_code'] ? $product->product['vendor_code'].'</br>' : ""  ?> <?= $product->product['title'] ?></td>
                        <td><?= $product->product_option ? $product->product_option : '' ?></td>
                        <td><?= $product->quantity ?> <?= $product->product->price_type_id == '1' ? 'кг': 'шт.'?></td>
                        <td><?= $product->price ?> руб.</td>
                        <td><?= $product->sum ?> руб.</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="alert alert-light order-step mt-5 mb-5" role="alert">
                <h3>На сумму <?= $order->amount?> руб.</h3>

                <?php if ($invoice) : ?>
                    <?= \yii\helpers\Html::a('Оплатить заказ', ['/sberbank/default/create', 'id' => $invoice->id /* id инвойса */], ['class' => 'btn btn-warning']) ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</main>
