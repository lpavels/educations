<?php
return [
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'timeZone' => 'Asia/Novosibirsk',
    //'homeUrl'=>'index',
    //'defaultRoute' => 'index',
    //'catchAll' => ['site/offline'], #Если сайт отключен, перенаправлять всех
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'compModel' => [
            'class' => 'common\models\ComponentModel',
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
                /* adress => action*/
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

                #USERS
                'users'=>'users/index', #index-search

                #NEWS CATEGORY
                'news-category'=>'news/category-index', #news category index
                'news-category-create'=>'news/category-create', #news category create
                'news-category-update'=>'news/category-update', #news category update
                'news-category-delete'=>'news/category-delete', #news category delete

                #Обучающие программы
                'training-theme-program'=>'training/theme-program-index', #темы обучающих программ (index)
                'training-theme-program-create'=>'training/theme-program-create', #темы обучающих программ (create)
                'training-theme-program-update'=>'training/theme-program-update', #темы обучающих программ (update)
                'training-theme-program-delete'=>'training/theme-program-delete', #темы обучающих программ (delete)

                #NEWS todo не доделано
                'news'=>'news/news-index', #news index
                'news-create'=>'news/news-create', #news create
                'news-update'=>'news/news-update', #news update
                'news-delete'=>'news/news-delete', #news delete
                //'news-view'=>'news/news-view', #news view

            ],
        ],
    ],
];
