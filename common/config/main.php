<?php
return [
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'timeZone' => 'Asia/Novosibirsk',
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
                'index' => 'site/index', #главная (без авторизации)
                'index-auth' => 'site/index-auth', #главная (после авторизации)
                'login' => 'site/login', #авторизация
                'signup' => 'site/signup', #регистрация
                'logout' => 'site/logout', #выход из системы
                'welcome' => 'site/welcome', #добро пожаловать

                'email-confirm' => 'site/email-confirm', #подтверждение электронной почты
                'confirm-email' => 'site/confirm-email', #страница подтверждения email

                'forgot-password' => 'site/forgot-password', #страница "забыли пароль?"
                'reset-password' => 'site/reset-password',  #страница изменения пароля -> "забыли пароль?"
                'confirm-password' => 'site/confirm-password', #страница подтверждения отправки и смены пароля

                #NEWS
                'news'=>'news/index', #news index
                'news/create'=>'news/create', #news index

                #USERS
                'users'=>'users/index', #users index-search
            ],
        ],
    ],
];
