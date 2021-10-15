<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use asmoday74\ckeditor5\EditorClassic;

?>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
        max-height: 400px;
    }
    .form-check, .form-group{
        padding: 0px;
    }
</style>
<div class="anotaciones-form">

    <?php $form = ActiveForm::begin(['id' => 'form']); ?>


    <?= $form->field($model, 'text')->widget(EditorClassic::className(),[
        'clientOptions' => [
            'language' => 'es',
            'uploadUrl' => 'upload',    //url for upload files
            'uploadField' => 'image',   //field name in the upload form
        ],
        'options' => [
            'row' => 6,
            'style' => 'height: 400px;',
            'width' => '100%',
            'height' => '400px',
       ],
    ])->label(false); ?>

   <!--  <div class="form-group">
        <?//= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
