<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Colaboradores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaboradores-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">

            <div class="col-md-6">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'fecha_nacimiento')->textInput(['type' => 'date']) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'fecha_ingreso')->textInput(['type' => 'date']) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'cuenta')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'cuenta_banco')->textInput(['maxlength' => true]) ?>
            </div>

                <!-- <?//= $form->field($model, 'portafolio_url')->textInput(['maxlength' => true]) ?> -->

            <div class="col-md-12">
                <?= $form->field($model, 'resumen')->textarea(['rows' => 6]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'photo_url')->fileInput(['id' => 'inputfile'])->label("Foto") ?>
            </div>

            <div class="col-md-6">
                <div class="form-group text-right">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary pl-5 pr-5']) ?>
                </div>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
