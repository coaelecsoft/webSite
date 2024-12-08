<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Master $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no')->textInput() ?>

    <?= $form->field($model, 'menu_option')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'page_active')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'page_option')->dropDownList([ '0', '1', '2', '3', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'page_option_1')->dropDownList([ '0', '1', '2', '3', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'title_sr_latn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_title_sr_latn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heading_sr_latn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_sr_latn')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text_sr_latn')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'basic_sr_latn')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link_sr_latn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heading_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_en')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text_en')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'basic_en')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_code')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zoom')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_1')->textInput() ?>

    <?= $form->field($model, 'data_2')->textInput() ?>

    <?= $form->field($model, 'menu_icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_option_1')->dropDownList([ '0', '1', '2', '3', '4', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
