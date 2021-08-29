<?php

/* @var $model common\models\SignupForm */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Изменение пароля';
?>

    <!-- reset password page -->
    <div class="div-window site-reset-password">
        <div class="row">
            <div class="logo col-2">
                <a href="/"><img src="asset/images/logo-nii.png" height="55" alt="logo"></a>
            </div>
            <div class="logo-text col-10">
                <h4 class="mt-0 mb-1">Изменение пароля</h4>
                <p class="text-muted mb-0">Введите новый пароль.</p>
            </div>
        </div>

        <?php $form = ActiveForm::begin(['id' => 'reset-password']); ?>


        <div class="input-form">
            <div class="icons"><i class="mdi mdi-lock"></i></div>
            <?= $form->field($model, 'password', ['options' => ['class' => 'input-window']])->passwordInput(['class' => 'form-control', 'placeholder' => 'Введите пароль'/*,'autofocus' => true*/]) ?>
        </div>

        <div class="input-form">
            <div class="icons"><i class="mdi mdi-key"></i></div>
            <?= $form->field($model, 'confirm_password', ['options' => ['class' => 'input-window']])->passwordInput(['class' => 'form-control', 'placeholder' => 'Подтвердите пароль'/*,'autofocus' => true*/]) ?>
        </div>

        <?= Html::submitButton('Изменить пароль', ['class' => 'btn btn-primary form-control', 'name' => 'reset-password-button']) ?>

        <?php ActiveForm::end(); ?>

    </div>
    <!-- End reset password page -->

<?php
$js = <<< JS
$('form').on('beforeSubmit', function(){
    var form = $(this);
    var submit = form.find(':submit');
    submit.html('<span class="fa fa-spin fa-spinner"></span> Пожалуйста, подождите...');
    submit.prop('disabled', true);
});
JS;
$this->registerJs($js, View::POS_READY);
?>