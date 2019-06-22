<main class="container">
    <h1 class="pt-5">Корзина</h1>

    <?php if($productsInCart) : ?>
    <table class="cart-table mb-2 mt-5">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Картинка</th>
            <th scope="col">Наименование</th>
            <th scope="col">Начинка</th>
            <th scope="col">Кол-во</th>
            <th scope="col">Цена</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>

        <?php $i = 1; foreach ($productsInCart as $product): ?>
        <tr>
            <th><?= $i++ ?></th>
            <td><img src="<?= $product['product']['prod_img'] ?>" alt="<?= $product['product']['title'] ? $product['product']['title'] : $product['product']['vendor_code'] ?>" class="cart-img"></td>
            <td><?= $product['product']['title'] ? $product['product']['title'] : $product['product']['vendor_code'] ?></td>
            <td><?= $product['product']['title'] ? $product['product']['title'] : $product['product']['vendor_code'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['product']['price'] ?></td>
            <td>
                <form action="<?= \yii\helpers\Url::to(['cart/cart-delete']) ?>" method="post">
                    <input type="hidden" name="_csrf-frontend" value="<?= Yii::$app->request->getCsrfToken()?>">
                    <input type="hidden" name="prod_id" value="<?=$product['id']?>">
                    <button type="submit" class="del-from-cart"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pb-3">Всего: 750 руб.</div>
    <div class="pb-5">
        <button class="btn btn-success">Сделать заказ</button>
        <button class="btn btn-primary">В магазин</button>
    </div>

    <?php else: ?>
        <div class="jumbotron pt-0 pb-0">
            <h1 class="display-4">Ваша корзина пуста</h1>
            <p class="lead"><img src="http://51cube.com.ua/foto/empty-cart.jpg" alt=""></p>
            <hr class="my-4">

            <p class="lead">
                <a class="btn btn-primary btn-lg" href="<?= \yii\helpers\Url::to(['category/index']) ?>" role="button">Перейти в магазин</a>
            </p>
        </div>
    <?php endif ?>

    <?php if (Yii::$app->session->getFlash('success_delete')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        Товар удален из корзины
    </div>
    <?php endif; ?>
</main>