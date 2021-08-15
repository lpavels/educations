<?php

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

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
        <link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="asset/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- Navbar -->
        <nav class="navbar-custom">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="/" class="logo">
                     <span>
                         <img src="asset/images/logo-sm.png" alt="logo-small" class="logo-sm">
                     </span>
                    <span>
                         <img src="asset/images/logo-lg.png" alt="logo-large" class="logo-lg">
                     </span>
                </a>
            </div>

            <ul class="list-unstyled topbar-nav float-right mb-1">
                <li class="dropdown">
                    <a class="nav-link nav-user" href="login">
                        <button type="button" class="btn btn-info waves-effect waves-light list-unstyled topbar-nav float-right mb-0">Авторизация</button>
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled topbar-nav float-right mb-0">
                <li class="dropdown">
                    <a class="nav-link nav-user" href="signup">
                        <button type="button" class="btn btn-info waves-effect waves-light list-unstyled topbar-nav float-right mb-0">Регистрация</button>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->

    <div class="page-wrapper-front">
        <div class="page-wrapper-inner-front">

            <!-- Page Content-->
            <div class="page-content-front">
                <div class="container-fluid">
                    <?= $content ?>
                </div><!-- container -->

                <footer class="footer text-center text-sm-left">
                    &copy; <?= Html::encode(Yii::$app->name) ?> 2020-<?= date('Y') ?><span
                            class="text-muted d-none d-sm-inline-block float-right">ФБУН "Новосибирский НИИ гигиены" Роспотребнадзора</span>
                </footer>
            </div>
            <!-- end page content -->
        </div>
    </div>
    <!-- end page-wrapper -->


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
