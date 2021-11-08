<?php

/* @var $model common\models\BlockedUsers */
/* @var $action backend\controllers\UsersController (actionModalUser) название действия с пользователем */
/* @var $action_id backend\controllers\UsersController (actionModalUser) id действия с пользователем */
/* @var $username backend\controllers\UsersController (actionModalUser) username пользователя */
/* @var $user_id backend\controllers\UsersController (actionModalUser) id пользователя */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$status = ($action_id==2) ? 0 : 1;
?>

<?php $form = ActiveForm::begin(['id' => 'form-modal-action']); ?>

<div class="modal-content">
    <div class="modal-header m-0">
        <h5 class="modal-title text-center text-danger mt-0" id="modalAction"><?= $action . $username.' (id='.$user_id.')' ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body mr-2 ml-2 p-0">
        <?= $form->field($model, 'user')->hiddenInput(['value' => $user_id, 'class' => 'form-control', 'readonly' => true])->label(false) ?>

        <?= $form->field($model, 'reason', ['options' => ['class' => 'm-1']])->textInput(['class' => 'form-control', 'placeholder' => 'Причина'])->label(false) ?>

        <?= $form->field($model, 'comment', ['options' => ['class' => 'm-1']])->textInput(['class' => 'form-control', 'placeholder' => 'Комментарий для администраторов'])->label(false) ?>

        <?= $form->field($model, 'status')->hiddenInput(['value' => $status, 'placeholder' => '0 - разблокирован, 1 - заблокирован'])->label(false) ?>
    </div>

    <div class="modal-footer">
        <?= Html::submitButton('Подтвердить удаление', ['class' => 'btn btn-danger waves-effect waves-light','name'=>'apply', 'value' => 'show']) ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
    </div>
</div><!-- /.modal-content -->

<?php ActiveForm::end(); ?>
