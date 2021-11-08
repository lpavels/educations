<?php

/* @var $model common\models\SignupForm */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Авторизация';
?>

<!-- Log In page -->
<div class="div-window site-login">
    <div class="row">
        <div class="logo col-2">
            <a href="/"><img src="asset/images/logo-nii.png" height="55" alt="logo"></a>
        </div>
        <div class="logo-text col-10">
            <h4 class="mt-0 mb-1">Авторизация</h4>
            <p class="text-muted mb-0">Войдите в систему для прохождения обучения.</p>
        </div>
    </div>

    <?php $form = ActiveForm::begin(['id' => 'form-login']); ?>
    <div class="input-form">
        <div class="icons"><i class="mdi mdi-account-outline"></i></div>
        <?= $form->field($model, 'username', ['options' => ['class' => 'input-window']])->textInput(['class' => 'form-control', 'placeholder' => 'Введите логин','autofocus' => true])->label('Логин') ?>
    </div>

    <div class="input-form">
        <div class="icons"><i class="mdi mdi-lock"></i></div>
        <?= $form->field($model, 'password', ['options' => ['class' => 'input-window']])->passwordInput(['class' => 'form-control', 'placeholder' => 'Введите пароль'/*,'autofocus' => true*/])->label('Пароль') ?>
    </div>

    <div class="input-form">
        <div class="col-8"></div>
        <div class="col-4 text-center"><a href="forgot-password" class="text-muted font-13 fst-italic"><i class="mdi mdi-lock"></i> Забыли пароль?</a></div>
    </div>

    <?= Html::submitButton('Авторизоваться', ['class' => 'btn btn-primary form-control', 'name' => 'login-button']) ?>

    <?php ActiveForm::end(); ?>

    <hr>
    <div class="m-1 text-center bg-light p-1 text-primary">
        <h6>Вы еще не зарегистрированы?</h6>
        <a href="signup" class="btn btn-primary m-3 btn-rounding">Регистрация</a>
    </div>

</div>
<!-- End Log In page -->

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