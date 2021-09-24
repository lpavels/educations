<?php

use backend\components\userHelp;
use yii\grid\GridView;
use yii\helpers\Html;
//use

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\UsersSearch */
/* @var $userRole_item \common\models\UsersSearch */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="userSearch-index">
    <h1 class="text-center text-light mb-4"><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $model,
        //'options' => [
        //    'class' => 'menus-table table-responsive'],
        'tableOptions' => [
            'class' => 'table table-bordered table-responsive'
        ],
        //'rowOptions' => ['class' => 'grid_table_tr'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                //'headerOptions' => ['class' => 'grid_table_th'],
            ],


            [
                'attribute' => 'auth_item_id',
                'value' => function ($model) {
                    return $model->getAuthItem($model->auth_item_id);
                },
                'filter' => $userRole_item
            ],
            'key_login',
            'username',
            'email',

            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getUserStatus($model->status);
                },
                'filter' => $model->userStatus(),
            ],

            'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{login} {view-user} {unblock-user} {block-user} {delete-user}',
                //'contentOptions' => ['class' => 'col-1'],
                'buttons' => [
                    'login' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-account-key"></i>', $url, [
                            'title' => Yii::t('yii', 'Авторизация'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-xs btn-primary'
                        ]);
                    },
                    'view-user' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'Просмотр действий'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-xs btn-info'
                        ]);
                    },
                    'unblock-user' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-lock-open"></i>', $url, [
                            'title' => Yii::t('yii', 'Разблокировать'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-xs btn-success'
                        ]);
                    },
                    'block-user' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-lock"></i>', $url, [
                            'title' => Yii::t('yii', 'Заблокировать'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-xs btn-warning'
                        ]);
                    },
                    'delete-user' => function ($url, $model, $key) {
                        return Html::a('<i class="mdi mdi-delete-empty"></i>', $url, [
                            'title' => Yii::t('yii', 'Удалить'),
                            'data-toggle' => 'tooltip',
                            'class' => 'btn btn-round btn-xs btn-danger'
                        ]);
                    },
                ],
            ]
            //[
            //    'attribute' => 'organization_id',
            //    'value' => function ($model) {
            //        //return $model->get_name_organization($model->organization_id);
            //    },
            //],
            //'name',
            //'date_birth',
            //'created_at',

        ],
    ]); ?>
</div>
