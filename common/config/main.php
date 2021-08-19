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
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'site/index', #главная (без авторизации)
                'index' => 'site/index-auth', #главная (после авторизации)
                'login' => 'site/login', #авторизация
                'signup' => 'site/signup', #регистрация
            ],
        ],
    ],
];
