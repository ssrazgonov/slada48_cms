<main class="container">
    <div class="row">
        <div class="col-mg-4">
            <div class="card mb-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center"><a href="" class="text-success">Редактирование профиля</a></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"><a href="" class="text-success">Мои заказы</a></li>
                    <!-- <span class="badge badge-primary badge-pill">14</span> -->
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <h1>
                Заказ номер: <?= $order->id ?>
            </h1>

            <div class="alert alert-light order-step mt-3 mb-3" role="alert">
                <h3>Состав заказа: на сумму <?= $order->amount?> руб.</h3>
            </div>

            <table class="cart-table mb-2 mt-5">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Изоображение</th>
                    <th scope="col">Наименование товара</th>
                    <th scope="col">Опции / Начинка</th>
                    <th scope="col">Кол-во грамм / штук</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Сумма</th>
                </tr>
                </thead>
                <tbody>

                <?php $sum = 0; $i = 1; foreach ($order->orderProduct as $product): ?>
                    <tr>
                        <th><?= $i++ ?></th>
                        <td><img src="<?= $product->product['prod_img'] ?>" alt="<?= $product->product['title'] ? $product->product['title'] : $product->product['vendor_code'] ?>" class="cart-img"></td>
                        <td><?= $product->product['vendor_code'] ? $product->product['vendor_code'].'</br>' : ""  ?> <?= $product->product['title'] ?></td>
                        <td><?= $product->product_option ? $product->product_option : '' ?></td>
                        <td><?= $product->quantity ?> <?= $product->product->price_type_id === '1' ? 'грамм': 'шт.'?></td>
                        <td><?= $product->price ?> руб.</td>
                        <td><?= $product->sum ?> руб.</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</main>
