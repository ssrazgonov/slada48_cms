<main class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
            <div class="row pb-5">
                <div class="col-md-12">
                    <div class="load-pic">
                        <div class="row p-3">
                            <div class="col-md-3 p-0">
                                <img id="upload_img_tag" src="/img/white-image.png" alt="" class="w-100">
                                <p>Нажмите «Выбрать файл» и выберите файл
                                    на вашем компьютере. Разрешены следующие
                                    форматы: <strong>JPG, PNG, GIF</strong></p>
                                <input style="display: none" type="file" name="" id="upload_img">
                                <label for="upload_img" id="upload_img" type="submit" class="btn btn-primary mt-3 w-100">Выбрать файл</label>
                            </div>
                            <div class="col-md-9 pl-5">
                                <?= $category->description ?>
                            </div>
                        </div>
                    </div>
                    <div class="order-form">
<!--                        <form>-->
<!--                            <div class="form-group">-->
<!--                                <label for="mass">Масса (кг) - не менее 2</label>-->
<!--                                <input type="number" class="form-control" id="mass" aria-describedby="emailHelp" placeholder="2">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="congratulate">Поздравительная надпись</label>-->
<!--                                <input type="password" class="form-control" id="congratulate" placeholder="Поздравляю с днем рождения">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="congratulate">Комментарий к заказу</label>-->
<!--                                <input type="password" class="form-control" id="congratulate" placeholder="Поздравляю с днем рождения">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="congratulate">Дата выдачи</label>-->
<!--                                <input type="password" class="form-control" id="congratulate" placeholder="Поздравляю с днем рождения">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="congratulate">Время выдачи</label>-->
<!--                                <input type="password" class="form-control" id="congratulate" placeholder="Поздравляю с днем рождения">-->
<!--                            </div>-->
<!---->
<!--                            <button type="submit" class="btn btn-success">Войти</button>-->
<!--                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>-->
<!--                        </form>-->

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 pt-5">

            <div class="card mb-2">
                <ul class="list-group list-group-flush">
                    <?php foreach ($categories as $cat):?>
                        <?php if ($cat->cat_slug == 'custom'): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><?= \yii\helpers\Html::a($cat['title'], ['custom/index']) ?></li>
                        <?php else: ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center"><?= \yii\helpers\Html::a($cat['title'], ['category/show', 'id' => $cat['id']]) ?><span class="badge badge-primary badge-pill"><?= $cat->productCount ?></span></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</main>

<?php
$this->registerJsFile('@web/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>