<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ColaboradoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaboradores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido') ?>

    <?= $form->field($model, 'fecha_nacimiento') ?>

    <?= $form->field($model, 'fecha_ingreso') ?>

    <?php // echo $form->field($model, 'resumen') ?>

    <?php // echo $form->field($model, 'cuenta') ?>

    <?php // echo $form->field($model, 'cuenta_banco') ?>

    <?php // echo $form->field($model, 'portafolio_url') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
