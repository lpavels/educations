<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsCategory */

$this->title = 'Добавление новости';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-create">

    <h1 class="title-page"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formNews', [
        'model' => $model,
    ]) ?>

</div>
