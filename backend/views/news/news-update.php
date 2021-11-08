<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsCategory */

$this->title = 'Редактирование новости: ';
$this->params['breadcrumbs'][] = ['label' => 'News Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование новости';
?>
<div class="news-category-update">

    <h1 class="title-page"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formNews', [
        'model' => $model,
    ]) ?>

</div>
