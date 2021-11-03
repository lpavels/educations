<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'news_category_id')->dropDownList($model->getNewsCategorys()) ?>

    <?= $form->field($model, 'theme_training_program_id')->dropDownList($model->getThemeTrainingPrograms()) ?>

    <?= $form->field($model, 'theme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'small_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_text')->textarea(['id'=>'elm1']) ?>

    <?//= $form->field($model, 'full_text')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'sequence_number')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Yii::$app->compModel->getStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

//TINYMCE WYSIHTML5
$this->registerJsFile('assets_copy/plugins/tinymce/tinymce.min.js');
$this->registerJsFile('assets_copy/pages/jquery.form-editor.init.js');
