<main class="container-fluid">

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">

            <?php use kartik\datetime\DateTimePicker;

            if (Yii::$app->user->isGuest) : ?>

            <div class="jumbotron">
                <h1 class="display-4">Требуется авторизация</h1>
                <p class="lead">Заказ торта по фото доступен только зарегистрированным пользователям</p>
                <hr class="my-4">
                <p>Войдите на сайт под своей учетной записью</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="<?= \yii\helpers\Url::to(['site/login']) ?>" role="link">Вход</a>
                </p>
                <hr class="my-4">
                <p>Зарегистрируйтесь у нас на сайте</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="<?= \yii\helpers\Url::to(['site/signup']) ?>" role="link">Регистрация</a>
                </p>
            </div>

            <?php endif; ?>

            <?php if (!Yii::$app->user->isGuest) : ?>
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

                                <div class="order-form">
                                    <?php $form = \yii\bootstrap4\ActiveForm::begin() ?>

                                        <?= $form->field($custom_form, 'weight', ['inputOptions' => [
                                            'autocomplete' => 'off']])
                                            ->label('Масса (кг) - не менее 2') ?>

                                        <?= $form->field($custom_form, 'text', ['inputOptions' => [
                                            'autocomplete' => 'off']])
                                            ->label('Поздравительная надпись') ?>

                                    <?= $form->field($custom_form, 'comment', ['inputOptions' => [
                                        'autocomplete' => 'off']])
                                        ->textarea()
                                        ->label('Комментарий к заказу') ?>

                                    <?= $form->field($custom_form, 'datetime', ['inputOptions' => [
                                        'autocomplete' => 'off']])
                                        ->widget(DateTimePicker::className(), [
                                            'bsVersion' => '4',
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                            ]
                                        ])
                                        ->label('Дата выдачи') ?>

                                        <button type="submit" class="btn btn-success">Заказать</button>

                                    <?php \yii\bootstrap4\ActiveForm::end() ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php endif; ?>

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