<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Темы обучающих программ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-training-program-index">

    <h1 class="title-page"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить тему программы', ['theme-program-create'], ['class' => 'btn btn-success mt-2']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{theme-program-update} {theme-program-delete}',
                //'contentOptions' => ['class' => 'col-1'],
                'buttons' => [
                    'theme-program-update' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-square-edit-outline"></i>', ['/training-theme-program-update', 'id' => $model->id], [
                            'title' => Yii::t('yii', 'Редактировать'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-xs btn-warning'
                        ]);
                    },
                    'theme-program-delete' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-delete-empty"></i>', ['/training-theme-program-delete', 'id'=>$model->id], [
                            'title' => Yii::t('yii', 'Удалить'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-danger btn-xs waves-effect waves-light',
                            'data' => [
                                'confirm' => 'Подтверждаете удаление тему обучающей программы?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ]
        ],
    ]); ?>


</div>
