<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ClientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa') ?>

    <?= $form->field($model, 'dominio') ?>

    <?= $form->field($model, 'logo_url') ?>

    <?= $form->field($model, 'representante_nombre') ?>

    <?php // echo $form->field($model, 'representante_telefono') ?>

    <?php // echo $form->field($model, 'representante_correo') ?>

    <?php // echo $form->field($model, 'tipo_servicio_id') ?>

    <?php // echo $form->field($model, 'importe_base') ?>

    <?php // echo $form->field($model, 'fecha_comienzo') ?>

    <?php // echo $form->field($model, 'tiempo_estimado') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
