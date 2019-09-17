<?php

use pantera\yii2\pay\sberbank\components\Sberbank;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'settings' => [
            'class' => '\common\components\Settings'
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                "register" => 'site/signup',
                "login" => 'site/login',
                "page/<id:\w+>" => 'page/index',
                "product/<id:\w+>" => 'product/index',
                "category" => 'category/index',
                "category/<id:\w+>" => 'category/show',
                "custom" => 'custom/index',
            ],
        ],
//        */
    ],

    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*'] // adjust this to your needs
        ],
        'sberbank' => [
//            'class' => 'pantera\yii2\pay\sberbank\Module',
            'class' => \pantera\yii2\pay\sberbank\Module::className(),
            'components' => [
                'sberbank' => [
                    'class' => pantera\yii2\pay\sberbank\components\Sberbank::className(),

                    // время жизни инвойса в секундах (по умолчанию 20 минут - см. документацию Сбербанка)
                    // в этом примере мы ставим время 1 неделю, т.е. в течение этого времени покупатель может
                    // произвести оплату по выданной ему ссылке
                    'sessionTimeoutSecs' => 60 * 60 * 24 * 7,

                    // логин api мерчанта
                    'login' => 'slada48-api',

                    // пароль api мерчанта
                    'password' => '',

                    // использовать тестовый режим (по умолчанию - нет)
                    'testServer' => false,
                ],
            ],

            // страница вашего сайта с информацией об успешной оплате
            'successUrl' => '/testpay/success',

            // страница вашего сайта с информацией о НЕуспешной оплате
            'failUrl' => '/testpay/fail',

            // обработчик, вызываемый по факту успешной оплаты
            'successCallback' => function($invoice){
                Yii::$app->session->setFlash('inv', $invoice);

                $order = \common\models\Order::findOne($invoice->order_id);
                $order->status = 2;
                $order->update();
            }
        ],
        ],
    'params' => $params,
];