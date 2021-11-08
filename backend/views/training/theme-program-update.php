<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ThemeTrainingProgram */

$this->title = 'Update Theme Training Program: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Theme Training Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="theme-training-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formThemeProgram', [
        'model' => $model,
    ]) ?>

</div>
