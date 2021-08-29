<?php

/* @var $model common\models\SignupForm */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Восстановление пароля';
?>

    <!-- forgot passwordpage -->
    <div class="div-window site-forgot-password">
        <div class="row">
            <div class="logo col-2">
                <a href="/"><img src="asset/images/logo-nii.png" height="55" alt="logo"></a>
            </div>
            <div class="logo-text col-10">
                <h4 class="mt-0 mb-1">Восстановление пароля</h4>
                <p class="text-muted mb-0">Введите логин или электронную почту для восстановления пароля</p>
            </div>
        </div>

        <?php $form = ActiveForm::begin([
                'id' => 'forgot-password',
            'validateOnSubmit' => false #отключение валидации на странице
        ]); ?>


        <div class="input-form">
            <div class="icons"><i class="mdi mdi-account-outline"></i></div>
            <?= $form->field($model, 'username', ['template'=>'{label}{input}','options' => ['class' => 'input-window']])->textInput(['class' => 'form-control', 'placeholder' => 'Введите логин','autofocus' => true])->label('Логин') ?>
        </div>


        <div class="input-form">
            <div class="icons"><i class="mdi mdi-email-outline"></i></div>
            <?= $form->field($model, 'email', ['template'=>'{label}{input}','options' => ['class' => 'input-window']])->textInput(['class' => 'form-control', 'placeholder' => 'Введите электронную почту'/*,'autofocus' => true*/])->label('Электронная почта') ?>
        </div>

        <?= Html::submitButton('Восстановить пароль', ['class' => 'btn btn-primary form-control', 'name' => 'forgot-password-button']) ?>

        <?php ActiveForm::end(); ?>

    </div>
    <!-- End forgot password page -->

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