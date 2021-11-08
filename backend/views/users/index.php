<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

//use

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\UsersSearch */
/* @var $userRole_item \common\models\UsersSearch */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;


?>
    <div class="userSearch-index">
        <h1 class="title-page"><?= Html::encode($this->title) ?></h1>

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
                    'template' => '{login} {view-user} {unblock-user} {block-user} {delete-modal-user}',
                    //'contentOptions' => ['class' => 'col-1'],
                    'buttons' => [
                        'login' => function ($url, $model, $key) {
                            return Html::a('<i class="mdi mdi-account-key"></i>', ['/login', 'id' => $model->id], [
                                'title' => Yii::t('yii', 'Авторизация'),
                                'data-toggle' => 'tooltip',
                                'class' => 'btn btn-round btn-xs btn-primary disabled'
                            ]);
                        },
                        'view-user' => function ($url, $model, $key) {
                            return Html::a('<i class="mdi mdi-eye"></i>', $url, [
                                'title' => Yii::t('yii', 'Просмотр действий'),
                                'data-toggle' => 'modal',
                                'data-animation' => 'bounce',
                                'data-target' => '.modal-user',
                                'class' => 'btn btn-round btn-info btn-xs waves-effect waves-light modalDialogXl',
                                'user_id' => $model->id,
                                'username' => $model->username,
                                'onclick' => '
                                    $.get("../users/modal-log?user_id=" + $(this).attr("user_id") + "&username=" + $(this).attr("username"), function(data){
                                        $(".modal-user .modal-dialog").empty();
                                        $(".modal-user .modal-dialog").append(data);
                                    });'
                            ]);
                        },
                        'unblock-user' => function ($url, $model, $key) {
                            return Html::a('<i class="mdi mdi-lock-open"></i>', $url, [
                                'title' => Yii::t('yii', 'Разблокировать'),
                                'data-toggle' => 'modal',
                                'data-animation' => 'bounce',
                                'data-target' => '.modal-user',
                                'class' => 'btn btn-round btn-success btn-xs waves-effect waves-light modalDialogCenter',
                                'user_id' => $model->id,
                                'username' => $model->username,
                                'action' => 2,
                                'onclick' => '
                                    $.get("../users/modal-user?user_id=" + $(this).attr("user_id") + "&username=" + $(this).attr("username")+ "&action=" + $(this).attr("action"), function(data){
                                        $(".modal-user .modal-dialog").empty();
                                        $(".modal-user .modal-dialog").append(data);
                                    });'
                            ]);
                        },
                        'block-user' => function ($url, $model, $key) {
                            return Html::a('<i class="mdi mdi-lock"></i>', $url, [
                                'title' => Yii::t('yii', 'Заблокировать'),
                                'data-toggle' => 'modal',
                                'data-animation' => 'bounce',
                                'data-target' => '.modal-user',
                                'class' => 'btn btn-round btn-warning btn-xs waves-effect waves-light modalDialogCenter',
                                'user_id' => $model->id,
                                'username' => $model->username,
                                'action' => 1,
                                'onclick' => '
                                    $.get("../users/modal-user?user_id=" + $(this).attr("user_id") + "&username=" + $(this).attr("username")+ "&action=" + $(this).attr("action"), function(data){
                                        $(".modal-user .modal-dialog").empty();
                                        $(".modal-user .modal-dialog").append(data);
                                    });'
                            ]);
                        },
                        'delete-modal-user' => function ($url, $model, $key) {
                            return Html::button('<i class="mdi mdi-delete-empty"></i>', [
                                'title' => Yii::t('yii', 'Удалить'),
                                'data-toggle' => 'modal',
                                'data-animation' => 'bounce',
                                'data-target' => '.modal-user',
                                'class' => 'btn btn-round btn-danger btn-xs waves-effect waves-light modalDialogCenter',
                                'user_id' => $model->id,
                                'username' => $model->username,
                                'action' => 0,
                                'onclick' => '
                                    $.get("../users/modal-user?user_id=" + $(this).attr("user_id") + "&username=" + $(this).attr("username") + "&action=" + $(this).attr("action"), function(data){
                                        $(".modal-user .modal-dialog").empty();
                                        $(".modal-user .modal-dialog").append(data);
                                    });'
                            ]);
                        },
                    ],
                ]
            ],
        ]); ?>
    </div>

    <div class="modal fade modal-user" tabindex="-1" role="dialog" aria-labelledby="UserModal" aria-hidden="true">
        <div class="modal-dialog ">

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



<?php
$js = <<<JS
function removeClassXl() {
    let divModalDialog = $("div .modal-dialog"); 
    divModalDialog.removeClass("modal-xl");
    divModalDialog.removeClass("modal-dialog-centered");
    divModalDialog.addClass("modal-xl");
}

$('.modalDialogXl').on('click',function (){
    removeClassXl();
})

function removeClassCenter() {
    let divModalDialog = $("div .modal-dialog"); 
    divModalDialog.removeClass("modal-xl");
    divModalDialog.removeClass("modal-dialog-centered");
    divModalDialog.addClass("modal-dialog-centered");
}

$('.modalDialogCenter').on('click',function (){
    removeClassCenter();
})
JS;
$this->registerJs($js, View::POS_READY);