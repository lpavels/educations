<?php

$flash = Yii::$app->session->getAllFlashes();
$this->title = ($flash['warning']) ?'Ссылка недействитена' : ((!$flash['error']) ? 'Электронная почта подтверждена' : 'Произошла ошибка');
?>

<!-- emailConfirm page -->
<div class="div-window site-emailConfirm">
    <div class="row">
        <div class="logo col-2">
            <a href="/"><img src="asset/images/logo-nii.png" height="55" alt="logo"></a>
        </div>
        <div class="logo-text col-10">
            <h4 class="mt-0 mb-1 text-success">Подтверждение электронной почты</h4>
            <p class="mt-3"><?= ($flash['warning']) ? 'Ссылка недействительна' : ((!$flash['error']) ? 'Электронная почта подтверждена, теперь вы можете авторизоваться для выбора программ обучения.' : 'Перейдите повторно по ссылке в электронной почте. Если проблема сохраняется напишите в техническую поддержку (' . Yii::$app->params['supportEmail'] . '). ');?></p>
        </div>
    </div>
</div>
<!-- End emailConfirm page -->
