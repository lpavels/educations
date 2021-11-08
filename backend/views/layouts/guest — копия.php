<?php

/* @var $content string */

use yii\helpers\Html;

$flash = Yii::$app->session->getAllFlashes();
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <!-- App css -->
        <link href="asset/css/bootstrap5.min.css" rel="stylesheet" type="text/css"/>
        <link href="asset/css/style-guest.css" rel="stylesheet" type="text/css"/>
        <link href="asset/css/icons.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <!-- navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="/" class="logo">
                <img src="asset/images/logo-guest-lg.png" alt="" class="logo-lg">
                <img src="asset/images/logo-guest-sm.png" alt="" class="logo-sm">
            </a>
        </div>

        <ul class="list-unstyled topbar-nav float-right mb-0">
            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <!--                        <img src="assets/images/users/user-1.jpg" alt="profile-user" class="rounded-circle"/>-->
                    <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Профиль</a>
                    <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Настойки</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Выход</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- END navbar -->

    <div class="page-wrapper-img"></div>

    <div class="page-content">
        <div class="row">
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();