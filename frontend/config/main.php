<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'es-ES',
    'components' => [
        'request' => [
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'estadisticas/local' => 'site/local-stats',
                'estadisticas/oficial' => 'site/official-stats',

                'app' => 'site/mobile-app',

                'contacto' => 'site/contact',

                'registrar' => 'site/signup',
                'recuperar' => 'site/request-password-reset',
                'centros' => 'site/center',
                'faq' => 'site/faq',

                'consultas' => 'site/quotes',
                'consultas/<id:\d+>' => 'site/quote',
                'POST consultas/<id:\d+>/mensaje' => 'site/quote-message',
                'POST consultas/<id:\d+>/estado' => 'site/quote-status',

                '<action>' => 'site/<action>',
                /*'<controller:[\w\-]+>/<id:\d+>' => '<controller>/view',
                '<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+' => '<controller>/<action>',*/

                [
                    'class' => 'yii\web\GroupUrlRule',
                    'prefix' => 'admin',
                    'rules' => [
                        'contacto' => 'contact/index',
                        'contacto/<id:\d+>' => 'contact/view',
                        'POST contacto/borrar/<id:\d+>' => 'contact/delete',

                        'faq' => 'faq/index',
                        'faq/crear' => 'faq/create',
                        'POST faq/categoria' => 'faq/create-category',
                        'faq/editar/<id:\d+>' => 'faq/update',
                        'POST faq/borrar/<id:\d+>' => 'faq/delete',

                        'consultas' => 'quote/index',
                        'consultas/<id:\d+>' => 'quote/view',
                        'POST consultas/<id:\d+>/experto' => 'quote/expert',
                    ]
                ]
            ],
        ],
    ],
    'params' => $params,
];
