<?php

/* @var $content string */

use yii\helpers\Html;
use yii\web\View;

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

        <!-- App favicon -->
        <!--        <link rel="shortcut icon" href="assets_copy/images/favicon.ico">-->

        <!--        <link href="assets_copy/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">-->

        <!-- App css -->
        <link href="assets_copy/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets_copy/css/icons.css" rel="stylesheet" type="text/css"/>
        <link href="assets_copy/css/metismenu.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets_copy/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <style>
        .alert-message {
            position: absolute;
            z-index: 1000;
            width: 60%;
            margin-right: 20%;
            margin-left: 20%;
        }
    </style>

    <!-- Alert Start -->
    <div class="alert-message text-center d-flex justify-content-center">
        <?php if ($flash['error']) { ?>
            <div class="alert alert-danger border-0 text-center" role="alert">
                <?php echo Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php } elseif ($flash['success']) { ?>
            <div class="alert alert-success border-0 text-center" role="alert">
                <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php } elseif ($flash['warning']) { ?>
            <div class="alert alert-warning border-0 text-center" role="alert">
                <?php echo Yii::$app->session->getFlash('warning'); ?>
            </div>
        <?php } ?>
    </div>
    <!-- Alert End -->

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
                </a>
            </div>

            <ul class="list-unstyled topbar-nav float-right mb-0">

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                       href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img src="assets_copy/images/users/user-1.jpg" alt="profile-user" class="rounded-circle"/>
                        <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Профиль</a>
                        <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Настройки</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout"><i class="dripicons-exit text-muted mr-2"></i> Выход</a>
                    </div>
                </li>
            </ul>

            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="button-menu-mobile nav-link waves-effect waves-light">
                        <i class="mdi mdi-menu nav-icon"></i>
                    </button>
                </li>
            </ul>

        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->
    <div class="page-wrapper-img">
        <div class="page-wrapper-img-inner">
            <div class="sidebar-user media">
                <img src="assets_copy/images/users/user-1.jpg" alt="user" class="rounded-circle img-thumbnail mb-1">
                <span class="online-icon"><i class="mdi mdi-record text-success"></i></span>
                <div class="media-body">
                    <h5 class="text-light"><?= Yii::$app->user->identity->username ?> </h5>
                    <p class="text-light" style="font-size: 10px"><?= Yii::$app->compModel->getUserRole() ?> </p>
                </div>
            </div>
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title mb-2"><i class="mdi mdi-monitor mr-2"></i>Dashboard</h4>
                        <div class="">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Frogetor</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Dashboard 1</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
        </div>
    </div>

    <div class="page-wrapper">
        <div class="page-wrapper-inner">

            <!-- Left Sidenav -->
            <div class="left-sidenav">

                <ul class="metismenu left-sidenav-menu" id="side-nav">

                    <li class="menu-title">Административные действия</li>

                    <li><a href="users"><i class="mdi dripicons-user"></i><span>Пользователи</span></a></li>

                    <li>
                        <a href="javascript: void(0);"><i class="mdi mdi-newspaper"></i><span>Новости</span>
                            <!--                            <span class="badge badge-danger badge-pill float-right">9+</span></a>-->
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="news">Новости</a></li>
                                <li><a href="news-category">Категории новостей</a></li>
                            </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);"><i class="mdi mdi-newspaper"></i><span>Обучающие программы</span>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="#">---</a></li>
                                <li><a href="training-theme-program">Темы программ</a></li>
                            </ul>
                    </li>

                    <li class="menu-title">More</li>

                </ul>
            </div>
            <!-- end left-sidenav-->

            <!-- Page Content-->
            <div class="page-content">
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

    <!-- jQuery  -->
    <script src="assets_copy/js/jquery.min.js"></script>
    <script src="assets_copy/js/bootstrap.bundle.min.js"></script>
    <script src="assets_copy/js/metisMenu.min.js"></script>
    <script src="assets_copy/js/waves.min.js"></script>
    <script src="assets_copy/js/jquery.slimscroll.min.js"></script>

    <!--    <script src="assets_copy/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>-->
    <!--    <script src="assets_copy/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->

    <!--    <script src="assets_copy/plugins/moment/moment.js"></script>-->
    <!--    <script src="assets_copy/plugins/apexcharts/apexcharts.min.js"></script>-->
    <!--    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>-->
    <!--    <script src="https://apexcharts.com/samples/assets/series1000.js"></script>-->
    <!--    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>-->
    <!--    <script src="assets_copy/pages/jquery.dashboard.init.js"></script>-->

    <!-- App js -->
    <script src="assets_copy/js/app.js"></script>

    <?php $this->endBody() ?>
    </body>
    </html>

<?php
$js = <<< JS
function hideAlert() {
  $('.alert-message').remove();
}

$(document).ready(function() {
  setTimeout(hideAlert, 7777);
})
JS;
$this->registerJs($js, View::POS_READY);

$this->endPage();