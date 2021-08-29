<?php

$flash = Yii::$app->session->getAllFlashes();
$this->title = ($flash['success2']) ? 'Изменение пароля': (($flash['warning']) ?'Ссылка недействитена' : ((!$flash['error']) ? 'Пароль изменен' : 'Произошла ошибка'));
?>

<!-- confirm password page -->
<div class="div-window site-confirm-password">
    <div class="row">
        <div class="logo col-2">
            <a href="/"><img src="asset/images/logo-nii.png" height="55" alt="logo"></a>
        </div>
        <div class="logo-text col-10">
            <h4 class="mt-0 mb-1 text-success">Изменение пароля</h4>
            <p class="mt-3"><?= ($flash['success2']) ? 'На электронную почту отправлена инструкция по изменению пароля.':(($flash['warning']) ? 'Ссылка недействительна' : ((!$flash['error']) ? 'Пароль изменен, теперь вы можете авторизоваться для выбора программ обучения.' : 'Перейдите повторно по ссылке в электронной почте. Если проблема сохраняется напишите в техническую поддержку (' . Yii::$app->params['supportEmail'] . '). '));?></p>
        </div>
    </div>
</div>
<!-- End confirm password page -->
