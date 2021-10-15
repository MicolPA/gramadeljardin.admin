<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TransaccionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transacciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo_id') ?>

    <?= $form->field($model, 'servicio_extra_id') ?>

    <?= $form->field($model, 'cliente_id') ?>

    <?= $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'fecha_pago') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
