<?php

/* @var $model common\models\SignupForm */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
?>

    <!-- Signup page -->
    <div class="div-window site-login">
        <div class="row">
            <div class="logo col-2">
                <a href="/"><img src="asset/images/logo-nii.png" height="55" alt="logo"></a>
            </div>
            <div class="logo-text col-10">
                <h4 class="mt-0 mb-1">Регистрация</h4>
                <p class="text-muted mb-0">Зарегистрируйтесь или авторизуйтесь для прохождения обучения.</p>
            </div>
        </div>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


        <div class="input-form">
            <div class="icons"><i class="mdi mdi-account-outline"></i></div>
            <?= $form->field($model, 'username', ['options' => ['class' => 'input-window']])->textInput(['class' => 'form-control', 'placeholder' => 'Введите имя пользователя','autofocus' => true]) ?>
        </div>

        <div class="input-form">
            <div class="icons"><i class="mdi mdi-email-outline"></i></div>
            <?= $form->field($model, 'email', ['options' => ['class' => 'input-window']])->textInput(['class' => 'form-control', 'placeholder' => 'Введите электронную почту','autofocus' => true]) ?>
        </div>

        <div class="input-form">
            <div class="icons"><i class="mdi mdi-lock"></i></div>
            <?= $form->field($model, 'password', ['options' => ['class' => 'input-window']])->passwordInput(['class' => 'form-control', 'placeholder' => 'Введите пароль'/*,'autofocus' => true*/]) ?>
        </div>

        <div class="input-form">
            <div class="icons"><i class="mdi mdi-key"></i></div>
            <?= $form->field($model, 'confirm_password', ['options' => ['class' => 'input-window']])->passwordInput(['class' => 'form-control', 'placeholder' => 'Подтвердите пароль'/*,'autofocus' => true*/]) ?>
        </div>

        <div class="input-form">
            <?= $form->field($model, 'check', ['template' => "<div class=\"check\"><input type=\"checkbox\" class=\"form-check-input\"/> Регистрируясь, вы соглашаетесь с \"<a href=\"#\">Условиями использования</a>\"</div>\n<div>{error}</div>"])->checkbox()->label(false)?>
        </div>

        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary form-control', 'name' => 'signup-button']) ?>

        <?php ActiveForm::end(); ?>

        <hr>
        <div class="m-1 text-center bg-light p-1 text-primary">
            <h6>Уже зарегистрированы?</h6>
            <a href="login" class="btn btn-primary m-3 btn-rounding">Авторизация</a>
        </div>

    </div>
    <!-- End Signup page -->

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