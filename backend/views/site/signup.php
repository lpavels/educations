<?php

/* @var $model common\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
?>

<!-- Log In page -->
<div class="site-signup col-xl-4">
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
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <div class="form-group">
                    <label>Логин</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account-outline font-16"></i></span>
                        </div>
                        <?= $form->field($model,'username', ['options' => ['id' => 'username','tag' => false]])->textInput(['class'=>'form-control','placeholder'=>'Введите логин','autofocus' => true])->label(false) ?>
                    </div>
                </div>


                <div class="form-group">
                    <label for="userpassword">Электронная почта (e-mail)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="mdi mdi-email-outline font-16"></i></span>
                        </div>
                        <?= $form->field($model,'email', ['template' => "{label}\n{input}",'options' => ['id' => 'email','tag' => false]])->textInput(['class'=>'form-control','placeholder'=>'Введите e-mail','autofocus' => true])->label(false) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="userpassword">Пароль</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3"><i class="mdi mdi-lock-outline font-16"></i></span>
                        </div>
                        <?= $form->field($model,'password', ['template' => "{label}\n{input}",'options' => ['id' => 'password','tag' => false]])->textInput(['class'=>'form-control','placeholder'=>'Введите пароль','autofocus' => true])->label(false) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="userpassword">Подтверждение пароля</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4"><i class="mdi mdi-key font-16"></i></span>
                        </div>
                        <?= $form->field($model,'confirm_password', ['template' => "{label}\n{input}",'options' => ['id' => 'confirm_password','tag' => false]])->textInput(['class'=>'form-control','placeholder'=>'Повторите пароль','autofocus' => true])->label(false) ?>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <div class="custom-control custom-checkbox">
                            <?= $form->field($model, 'check')->checkbox(['checked' => false])->label(false) ?>

                            <label class="custom-control-label" for="customControlInline">
                                <span class="font-13 text-muted mb-0">Регистрируясь, вы соглашаетесь с <a href="#">Пользовательским соглашением</a></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                            <label class="custom-control-label" for="customControlInline">
                                <span class="font-13 text-muted mb-0">Регистрируясь, вы соглашаетесь с <a href="#">Пользовательским соглашением</a></span>
                            </label>
                        </div>
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
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary btn-block waves-effect waves-light', 'name' => 'signup-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <div class="m-3 text-center bg-light p-3 text-primary">
                <h5 class="">Уже зарегистрированы?</h5>
                <a href="login" class="btn btn-primary btn-round waves-effect waves-light">Авторизоваться</a>
            </div>
        </div>
    </div>
</div>
<!-- End Log In page -->



<!---->
<!---->
<?php
//
///* @var $this yii\web\View */
///* @var $form yii\bootstrap4\ActiveForm */
///* @var $model common\models\SignupForm */
//
//use yii\bootstrap4\Html;
//use yii\bootstrap4\ActiveForm;
//
//$this->title = 'Signup';
//$this->params['breadcrumbs'][] = $this->title;
//?>
<!--<div class="site-signup">-->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <p>Please fill out the following fields to signup:</p>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-lg-5">-->
<!--            --><?php //$form = ActiveForm::begin(['id' => 'form-signup']); ?>
<!---->
<!--                --><?//= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<!---->
<!--                --><?//= $form->field($model, 'email') ?>
<!---->
<!--                --><?//= $form->field($model, 'password')->passwordInput() ?>
<!---->
<!--                <div class="form-group">-->
<!--                    --><?//= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
<!--                </div>-->
<!---->
<!--            --><?php //ActiveForm::end(); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
