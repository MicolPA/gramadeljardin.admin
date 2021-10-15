<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<?php $form = ActiveForm::begin(['enableClientScript' => false], ['enctype' => 'multipart/form-data']); ?>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'empresa')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
        <?= $form->field($model, 'dominio')->textInput(['maxlength' => true])->label('Dominio (Si tiene)') ?>
        </div>

        <div class="col-md-6 pt-3">
            <?php if ($model): ?>
                <?= $form->field($model, 'logo_url')->fileInput(['id' => 'inputfile']) ?>
            <?php else: ?>
                <?= $form->field($model, 'logo_url')->fileInput(['required' => 'required', 'id' => 'inputfile']) ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'representante_nombre')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-6">
            <?= $form->field($model, 'representante_telefono')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'representante_correo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-12 text-right pt-4 pb-4">
            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary pr-5 pl-5']) ?>
            </div>
        </div>

    </div>
<?php ActiveForm::end(); ?>
