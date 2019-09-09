<div style="min-height: 100vh">
    <form action="/testpay" method="post">
        <?= \yii\helpers\Html::hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
        <?= \yii\helpers\Html::submitButton('Оплатить') ?>
    </form>

    <?php if(isset($invoice)) : ?>
        <?= \yii\helpers\Html::a('Оплатить заказ', ['/sberbank/default/create', 'id' => $invoice->id /* id инвойса */]) ?>
    <?php endif; ?>
</div>

