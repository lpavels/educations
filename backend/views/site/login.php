<?php

/* @var $model common\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Авторизация';
?>

<!-- Log In page -->
<div class="site-login col-xl-4">
    <div class="card mb-0 shadow-none">
        <div class="card-body">
            <div class="px-3">
                <div class="media">
                    <a href="/" class="logo logo-admin"><img src="asset/images/logo-sm.png" height="55" alt="logo" class="my-3"></a>
                    <div class="media-body ml-3 align-self-center">
                        <h4 class="mt-0 mb-1">Авторизация</h4>
                        <p class="text-muted mb-0">Войдите в систему для прохождения обучения.</p>
                    </div>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'form-login']); ?>

                <div class="form-group">
                    <label>Логин/идентификационный номер</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account-outline font-16"></i></span>
                        </div>
                        <?= $form->field($model,'username', ['options' => ['id' => 'username','tag' => false]])->textInput(['class'=>'form-control','placeholder'=>'Введите пароль','autofocus' => true])->label(false) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="userpassword">Пароль</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="mdi mdi-key font-16"></i></span>
                        </div>
                        <?= $form->field($model,'password', ['template' => "{label}\n{input}",'options' => ['id' => 'password','tag' => false]])->textInput(['class'=>'form-control','placeholder'=>'Введите пароль','autofocus' => true])->label(false) ?>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6 text-right">
                        <a href="#" class="text-muted font-13"><i class="mdi mdi-lock"></i>Забыли пароль?</a>
                    </div>
                </div>

                <div class="form-group mb-0 row">
                    <div class="col-12 mt-2">
                        <?= Html::submitButton('Авторизоваться', ['class' => 'btn btn-primary btn-block waves-effect waves-light', 'name' => 'login-button']) ?>
<!--                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Авторизоваться <i class="fas fa-sign-in-alt ml-1"></i></button>-->
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
            <div class="m-3 text-center bg-light p-3 text-primary">
                <h5 class="">Вы еще не зарегистрированы?</h5>
                <a href="signup" class="btn btn-primary btn-round waves-effect waves-light">Регистрация</a>
            </div>
        </div>
    </div>
</div>
<!-- End Log In page -->