<?php

/* @var $content string */

#use backend\assets\AppAsset;
use yii\helpers\Html;

//AppAsset::register($this);
#print_r(Yii::$app->session->getAllFlashes());

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
        <link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="asset/css/icons.css" rel="stylesheet" type="text/css"/>
        <link href="asset/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="p-5"></div>

    <!--  Сообщение на странице  -->
    <?php if($flash['error']){?>
        <div class="alert alert-danger border-0" role="alert">
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php } elseif ($flash['success']){?>
        <div class="alert alert-success border-0" role="alert">
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php } ?>
    <!--  Сообщение на странице (END)  -->

    <div class="row">
        <div class="col-lg-4 "></div>
        <?= $content ?>
        <div class="col-lg-4 "></div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();