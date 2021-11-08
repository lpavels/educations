<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории новостей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-index">

    <h1 class="title-page"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить категорию', ['/news-category-create'], ['class' => 'btn btn-success mt-2']) ?>
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
                'template' => '{news-category-update} {news-category-delete}',
                //'contentOptions' => ['class' => 'col-1'],
                'buttons' => [
                    'news-category-update' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-square-edit-outline"></i>', ['/news-category-update', 'id' => $model->id], [
                            'title' => Yii::t('yii', 'Редактировать'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-xs btn-warning'
                        ]);
                    },
                    'news-category-delete' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-delete-empty"></i>', ['/news-category-delete', 'id'=>$model->id], [
                            'title' => Yii::t('yii', 'Удалить'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-danger btn-xs waves-effect waves-light',
                            'data' => [
                                'confirm' => 'При удалении категории будут удалены все новости из данной категории. Подтверждаете удаление?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ]
        ],
    ]); ?>


</div>
