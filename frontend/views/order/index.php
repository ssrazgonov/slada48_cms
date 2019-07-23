
<main class="container">
    <h1 class="mt-5 mb-5">Оформление заказа</h1>

    <div class="alert alert-light order-step" role="alert">
        <h3>Мои товары:</h3>
    </div>
    <table class="cart-table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Изоображение</th>
            <th scope="col">Наименование товара</th>
            <th scope="col">Опции / Начинка</th>
            <th scope="col">Кол-во грамм / штук</th>
            <th scope="col">Цена</th>
            <th scope="col">Сумма</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>

        <?php use yii\bootstrap\ActiveForm;
        use yii\helpers\Html;

        $sum = 0; $i = 1; foreach ($productsInCart as $product): ?>
            <tr>
                <th><?= $i++ ?></th>
                <td><img src="<?= $product['product']['prod_img'] ?>" alt="<?= $product['product']['title'] ? $product['product']['title'] : $product['product']['vendor_code'] ?>" class="cart-img"></td>
                <td><?= $product['product']['vendor_code'] ? $product['product']['vendor_code'].'</br>' : ""  ?> <?= $product['product']['title'] ?></td>
                <td><?= $product['option'] ? $product['option']['description'] : '' ?></td>

                <td><?= $product['quantity'] ?> <?= $product['product']['price_type_id'] === '1' ? 'грамм': 'шт.'?></td>
                <td><?= $product['product']['price'] ?> руб.</td>

                <!-- Логика расчета цены зависит от типа цены, может быть за граммы а может быть за штуки -->
                <?php $average = $product['product']['price_type_id'] === '1'? $product['product']['price'] / 1000 *  $product['quantity'] : $product['product']['price'] *  $product['quantity']?>
                <td><?= $average ?> руб.</td>
                <?php $sum += $average; ?>
                <td>
                    <form action="<?= \yii\helpers\Url::to(['cart/cart-delete']) ?>" method="post">
                        <input type="hidden" name="_csrf-frontend" value="<?= Yii::$app->request->getCsrfToken()?>">
                        <input type="hidden" name="prod_id" value="<?=$product['id']?>">
                        <input type="hidden" name="url_back" value="order/index">
                        <button type="submit" class="del-from-cart"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (Yii::$app->user->isGuest):?>
        <div class="alert alert-light order-step mt-3 mb-3" role="alert">
            <h3>Вход на сайт</h3>
        </div>

        <div class="row">
            <div class="col-lg-6 col-lg-push-2">
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => ['order/index']]); ?>

                <?= $form->field($loginForm, 'username')->textInput(['autofocus' => true])->label('Имя пользователя') ?>

                <?= $form->field($loginForm, 'password')->passwordInput()->label('Пароль') ?>

                <?= $form->field($loginForm, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

        </div>

        <div class="alert alert-light order-step mt-3 mb-3" role="alert">
            <h3>Регистрация</h3>
        </div>

        <div class="row">

            <div class="col-lg-6">

                <?php $form = ActiveForm::begin(['id' => 'form-signup', 'action' => ['order/index']]); ?>

                <?= $form->field($signupForm, 'username')->textInput(['autofocus' => true])->label('Имя пользователя') ?>

                <?= $form->field($signupForm, 'email')->label('E-mail') ?>

                <?= $form->field($signupForm, 'password')->passwordInput()->label('Пароль') ?>

                <div class="form-group">
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-6">
                <div>Регистрируясь на сайте, вы подтверждаете то, что вы озакомились, принимаете и обязуетесь следовать нашим правилам:</div>
                <ul>
                    <li>
                        <a href="">Пользовательское соглашение</a>
                    </li>
                    <li><a href="">Политика конфинденциальности</a></li>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!Yii::$app->user->isGuest):?>
        <div class="alert alert-light order-step mt-3 mb-3" role="alert">
            <h3>Ваш профиль покупателя:</h3>
        </div>

        <ul class="user_incart">
            <li><?= Yii::$app->user->identity->username ?></li>
            <li><?= Yii::$app->user->identity->email ?></li>
            <li><?= Yii::$app->user->identity->phone ?></li>
        </ul>
    <?php endif; ?>

	<?php if (!Yii::$app->user->isGuest):?>
        <div class="alert alert-light order-step mt-3 mb-3" role="alert">
            <h3>Выберите метод оплаты:</h3>
        </div>

		<div class="row">
			<div class="col-lg-12">

                <?php $pMForm->paymentMethod = Yii::$app->session->has('paymentMethod') ? Yii::$app->session->get('paymentMethod') : 1?>
                <?php $form = ActiveForm::begin(['id' => 'form-pMethod']); ?>

                    <?= $form->field($pMForm, 'paymentMethod')->radioList($paymentMethods, [
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $checked = $checked ? 'checked' : '';
                                return "
                                    <div class=\"custom-control custom-radio\">
                                        <input $checked name=\"PMethodForm[paymentMethod]\" type=\"radio\" class=\"custom-control-input\" id=\"pMethod_$value\" value=\"$value\">
                                        <label class=\"custom-control-label\" for=\"pMethod_$value\">{$label}</label>
                                    </div>
                                ";
                            },
                    ])->label(''); ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::$app->session->has('paymentMethod') ? 'Сменить метод оплаты' : 'Продолжить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
		</div>
	<?php endif; ?>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->session->has('paymentMethod')):?>
        <div class="alert alert-light order-step mt-3 mb-3" role="alert">
            <h3>Подтверждение оформления заказа:</h3>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'form-pMethod', 'action' => \yii\helpers\Url::to(['order/create'])]); ?>

            <div class="form-group">
                <label for="orderNote">Дополните заказ вашими пожеланиями:</label>
                <textarea class="form-control mb-3" name="orderNote" id="orderNote" cols="30" rows="3"></textarea>
                <?= Html::submitButton('Завершить оформление заказа', ['class' => 'btn btn-warning', 'name' => 'signup-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>

</main>
