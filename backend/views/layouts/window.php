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
        <link href="asset/css/style-window.css" rel="stylesheet" type="text/css"/>
        <link href="asset/css/icons.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="container-fluid" style="display: flex;">
        <div class="div-centered">
            <!--  Сообщение на странице  -->
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
            <!--  Сообщение на странице (END)  -->
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();