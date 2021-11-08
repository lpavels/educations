<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ThemeTrainingProgram */

$this->title = 'Добавление темы обучающей программы';
$this->params['breadcrumbs'][] = ['label' => 'Темы обучающих программ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-training-program-create">

    <h1 class="title-page"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formThemeProgram', [
        'model' => $model,
    ]) ?>

</div>
