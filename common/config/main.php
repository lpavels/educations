<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'ComponetSite' => [
            'class' => 'common\models\ComponetSite',
        ],

        #'authManager' => [
        #    'class' => 'yii\rbac\DbManager',
        #],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '/' => 'site/index', #главная (без авторизации)
                'index' => 'site/index-auth', #главная (после авторизации)
                'login' => 'site/login', #авторизация
                'signup' => 'site/signup', #регистрация
                'welcome' => 'site/welcome', #добро пожаловать

                'email-confirm' => 'site/email-confirm', #подтверждение электронной почты
                'confirm-email' => 'site/confirm-email', #страница подтверждения email

                'forgot-password' => 'site/forgot-password', #страница "забыли пароль?"
                'confirm-password' => 'site/confirm-password', #страница подтверждения отправки и смены пароля


                'reset-password' => 'site/reset-password',  #страница изменения пароля -> "забыли пароль?"
            ],
        ],
    ],
];
