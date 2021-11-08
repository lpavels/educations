<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-index">

    <h1 class="title-page"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новость', ['news/news-create'], ['class' => 'btn btn-success mt-2']) ?>
    </p>


    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'attribute' => 'theme_training_program_id',
                    'value' => function ($model) {
                        return $model->getThemeTrainingPrograms($model->theme_training_program_id);
                    },
                ],
                [
                    'attribute' => 'news_category_id',
                    'value' => function ($model) {
                        return $model->getNewsCategorys($model->news_category_id);
                    },
                ],
                'theme',
                'small_text',
                //'full_text:html',
                'sequence_number',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return Yii::$app->compModel->getStatus($model->status);
                    },
                ],
                'created_at',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{news-update} {news-delete}',
                    //'contentOptions' => ['class' => 'col-1'],
                    'buttons' => [
                        'news-update' => function ($url, $model, $key) {
                            return Html::a(
                                '<i class="mdi mdi-square-edit-outline"></i>',
                                ['/news-update', 'id' => $model->id],
                                [
                                    'title' => Yii::t('yii', 'Редактировать'),
                                    'data-toggle' => 'tooltip',
                                    'class' => 'btn btn-round btn-xs btn-warning'
                                ]
                            );
                        },
                        'news-delete' => function ($url, $model, $key) {
                            return Html::a(
                                '<i class="mdi mdi-delete-empty"></i>',
                                ['/news-delete', 'id' => $model->id],
                                [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'data-toggle' => 'tooltip',
                                    'class' => 'btn btn-round btn-danger btn-xs waves-effect waves-light',
                                    'data' => [
                                        'confirm' => 'Подтверждаете удаление новости?',
                                        'method' => 'post',
                                    ],
                                ]
                            );
                        },
                    ],
                ]
            ],
        ]
    ); ?>


</div>
