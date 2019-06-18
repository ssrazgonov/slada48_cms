<main class="container-fluid">
    <h1><?= $category[0]->title ?></h1>
    <div class="row">

        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">

            <div class="row pb-5">

            <?php foreach ($products as $product) : ?>
                <section class="col-lg-3 col-sm-6 pt-5">
                    <div class="card cakes">
                        <a href="<?= \yii\helpers\Url::to(['product/index', 'id' => $product->id]) ?>"><img class="card-img-top border-bottom p-3" src="<?= $product->prod_img ?>" alt="Card image cap"></a>
                        <div class="card-body">
                            <h2 class="card-title"><a class="text-success" href="<?= \yii\helpers\Url::to(['product/index', 'id' => $product->id]) ?>"><?= $product->title ?></a></h2>
                            <div class="">
                                <p><?= $product->prod_slug ?></p>
                                <p><?= $product->price ?> руб. за кг.</p>
                                <button class="btn btn-success">В корзину</button>
                            </div>

                        </div>
                    </div>
                </section>
            <?php endforeach; ?>


            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 pt-5">
            <div class="card mb-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">По порядку</label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">По возрастанию цены</label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">По убыванию цены</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card mb-2">
                <ul class="list-group list-group-flush">
                    <?php foreach ($categories as $cat):?>
                    <li class="list-group-item d-flex justify-content-between align-items-center"><?= \yii\helpers\Html::a($cat['title'], ['category/show', 'id' => $cat['id']]) ?><span class="badge badge-primary badge-pill"><?= $cat['prod_count'] ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</main>