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
<!--        <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">-->

        <!-- App css -->
        <link href="assets_copy/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets_copy/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets_copy/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="assets_copy/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <?php $this->beginBody() ?>

    <!-- navbar -->
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- Navbar -->
        <nav class="navbar-custom">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="/" class="logo">
                    <span>
                        <img src="asset/images/logo-guest-lg.png" alt="logo-small" class="logo-sm">
                    </span>
                    <span>
                        <img src="http://www.niig.su/templates/niig_tpl/images/logo.png" alt="logo-large" class="logo-lg">
                    </span>
                </a>
            </div>

            <ul class="topbar-nav float-right mb-0">
                <a href="login"><button class="btn btn-info m-1 auth-btn">Авторизация</button></a>
                <a href="signup"><button class="btn btn-info m-1 auth-btn">Регистрация</button></a>
            </ul>

        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->
    <!-- END navbar -->

    <div class="page-wrapper-img"></div>

    <div class="page-content">
        <div class="row">
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
<!--     jQuery  -->
<!--    <script src="assets_copy/js/jquery.min.js"></script>-->
<!--    <script src="assets_copy/js/bootstrap.bundle.min.js"></script>-->
<!--    <script src="assets_copy/js/metisMenu.min.js"></script>-->
<!--    <script src="assets_copy/js/waves.min.js"></script>-->
<!--    <script src="assets_copy/js/jquery.slimscroll.min.js"></script>-->
<!---->
<!--    <script src="assets_copy/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>-->
<!--    <script src="assets_copy/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->
<!---->
<!--    <script src="assets_copy/plugins/moment/moment.js"></script>-->
<!--    <script src="assets_copy/plugins/apexcharts/apexcharts.min.js"></script>-->
<!--    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>-->
<!--    <script src="https://apexcharts.com/samples/assets/series1000.js"></script>-->
<!--    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>-->
<!--    <script src="assets_copy/pages/jquery.dashboard.init.js"></script>-->
<!---->
<!--     App js -->
<!--    <script src="assets/js/app.js"></script>-->
    </body>
    </html>
<?php $this->endPage();