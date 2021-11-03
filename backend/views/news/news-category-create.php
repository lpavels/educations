<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsCategory */

$this->title = 'Добавление новостной категории';
$this->params['breadcrumbs'][] = ['label' => 'News Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-create">

    <h1 class="title-page"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCategory', [
        'model' => $model,
    ]) ?>

</div>
