<main class="container-fluid">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <div class="row pb-5 pt-5">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><img src="<?= $product->prod_img ?>" alt="" class="cake-single-img w-100"></div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="cake-description">
                        <h1 class="border-bottom border-dark pb-2"><?= $product->title ?></h1>
                        <p><?= $product->description ?></p>
                        <p>Арт. <?= $product->article ?></p>
                        <p><span>Цена за 1 кг: </span><strong> <?= $product->price ?> руб.</strong></p>
                    </div>

                    <div class="row p-3">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                            <strong>начинки на выбор:</strong>
                        </div>

                        <div class="col-2 p-1">
                            <label class="cake-filling-lbl">
                                <input class="cake-filling-radio" data-target="1" type="radio" name="test" value="n1" checked>
                                <img src="img/nachinka1.png" class="w-100" title="Слои белого бисквита пропитаны сиропом и соединены между собой поочередно сырным кремом с прослойкой из конфитюра черная смородина.">
                            </label>
                        </div>
                        <div class="col-2 p-1">
                            <label class="cake-filling-lbl">
                                <input class="cake-filling-radio" data-target="2" type="radio" name="test" value="n2">
                                <img src="img/nachinka2.jpg" class="w-100" title="Слои медового полуфабриката соединены между собой сливочным кремом с вареным сгущенным молоком.">
                            </label>
                        </div>
                        <div class="col-2 p-1">
                            <label class="cake-filling-lbl">
                                <input class="cake-filling-radio" data-target="3" type="radio" name="test" value="n3">
                                <img src="img/nachinka3.jpg" class="w-100">
                            </label>
                        </div>
                        <div class="col-2 p-1">
                            <label class="cake-filling-lbl">
                                <input class="cake-filling-radio" data-target="4" type="radio" name="test" value="n4">
                                <img src="img/nachinka4.jpg" class="w-100">
                            </label>
                        </div>
                        <div class="col-2 p-1">
                            <label class="cake-filling-lbl">
                                <input class="cake-filling-radio"data-target="5" type="radio" name="test" value="n5">
                                <img src="img/nachinka5.png" class="w-100">
                            </label>
                        </div>
                        <div class="col-2 p-1">
                            <label class="cake-filling-lbl">
                                <input class="cake-filling-radio" data-target="6" type="radio" name="test" value="n6">
                                <img src="img/nachinka6.jpg" class="w-100">
                            </label>
                        </div>

                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <strong>Описание начинки:</strong>

                        <p data-id="1" class="cake-filling-des cake-filling-des_show">
                            Слои белого бисквита пропитаны сиропом и соединены между собой поочередно сырным кремом с прослойкой из конфитюра черная смородина.
                        </p>
                        <p data-id="2" class="cake-filling-des">
                            Слои белого бисквита пропитаны сиропом и соединены между собой поочередно сырным кремом с прослойкой из конфитюра сладкая малина.
                        </p>
                        <p data-id="3" class="cake-filling-des">
                            Слои белого бисквита пропитаны сиропом и соединены между собой поочередно сырным кремом с прослойкой из конфитюра безумный банан.
                        </p>
                        <p data-id="4" class="cake-filling-des">
                            Слои белого бисквита пропитаны сиропом и соединены между собой поочередно сырным кремом с прослойкой из конфитюра отвязная дыня.
                        </p>
                        <p data-id="5" class="cake-filling-des">
                            Слои белого бисквита пропитаны сиропом и соединены между собой поочередно сырным кремом с прослойкой из конфитюра вишенка-черешенка.
                        </p>
                        <p data-id="6" class="cake-filling-des">
                            Слои белого бисквита пропитаны сиропом и соединены между собой поочередно сырным кремом с прослойкой из конфитюра.
                        </p>

                    </div>
                    <div class="buy-btn-shell pt-2">
                        <button class="btn btn-primary">Задать вопрос</button>
                        <button class="btn btn-success">В корзину</button>
                    </div>
                </div>
            </div>
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