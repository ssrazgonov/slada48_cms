<?php
use yii\helpers\Url;
?>

<main class="container-fluid">
    <div class="row">


            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <form action="<?= Url::to(['cart/cart-add']) ?>" method="post">

                    <input type="hidden" name="_csrf-frontend" value="<?= Yii::$app->request->getCsrfToken()?>">
                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <div class="row pb-5 pt-5">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><img src="/upload/product/<?= $product->id ?>/<?= $product->prod_img ?>" alt="" class="cake-single-img w-100"></div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="cake-description">
                            <h1 class="border-bottom border-dark pb-2"><?= $product->title ?></h1>
                            <p><?= $product->description ?></p>
                            <p>Арт. <?= $product->vendor_code ?></p>
                            <?php if($product->price_type_id === 1): ?>
                                <p><span>Цена за 1000 грамм: </span><strong> <?= $product->price ?> руб.</strong></p>
                            <?php else: ?>
                                <p><span>Цена за штуку: </span><strong> <?= $product->price ?> руб.</strong></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <div><strong>Выберите количество: </strong></div>
                            <?php if ($product->min): ?> <div>Минимальное кол-во: <?= $product->min ?></div> <?php endif; ?>
                            <select name="product_quantity" id="">

                                <?php if($product->price_type_id === 1): ?>

                                    <?php for ($i = 2000; $i < 5000; $i += 100) : ?>
                                        <option value="<?= $i ?>"><?= $i ?> гр.</option>
                                    <?php endfor; ?>
                                <?php else: ?>
                                    <?php $min = $product->min ? $product->min : 1; ?>
                                    <?php for ($i = $min; $i < 100; $i++) : ?>
                                        <option value="<?= $i ?>"><?= $i ?> шт.</option>
                                    <?php endfor; ?>
                                <?php endif; ?>



                            </select>
                            <?php ?>
                        </div>

                        <div class="row p-3">
                            <?php if ($product->productOption): ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                    <strong>Начинки на выбор:</strong>
                                </div>
                            <?php endif; ?>

                            <?php foreach ($product->productOption as $option): ?>
                                <div class="col-2 p-1">
                                    <label class="cake-filling-lbl">
                                        <input class="cake-filling-radio" data-target="<?= $option->id ?>" type="radio" name="product_option" value="<?= $option->id ?>">
                                        <img src="<?= $option->img ?>" class="w-100" title="<?= $option->description ?>">
                                    </label>
                                </div>
                            <?php endforeach; ?>

                        </div>

                        <?php if ($product->productOption): ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                <strong>Описание начинки:</strong>

                                <?php $show = true; ?>
                                <?php foreach ($product->productOption as $option): ?>
                                    <p data-id="<?= $option->id ?>" class="cake-filling-des <?php echo $show ? 'cake-filling-des_show' : ''; $show = false; ?> ">
                                        <?= $option->description ?>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="buy-btn-shell pt-2">
                            <button class="btn btn-primary">Задать вопрос</button>
                            <button type="submit" class="btn btn-success">В корзину</button>
                        </div>

                        <?php if (Yii::$app->session->getFlash('success_add')): ?>
                            <div class="alert alert-success alert-dismissible fade show mt-2">
                                Товар успешно добавлен
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                </form>
            </div>



        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pt-5">
            <div class="card mb-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center"><h4><?= $category->title ?></h4></li>

                    <?php foreach ($products as $product): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center"><a href="<?= \yii\helpers\Url::to(['product/index', 'id' => $product->id]) ?>" class="text-success"><?= $product->title ?></a></li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center"><a href="<?= \yii\helpers\Url::to(['category/show', 'id' => $category->id]) ?>" class="text-primary">Все торты категории -></a></li>
                </ul>
            </div>
        </div>
    </div>
</main>