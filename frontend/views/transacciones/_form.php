<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$get = Yii::$app->request->get();
?>

<div class="transacciones-form">

    <?php $form = ActiveForm::begin(['enableClientScript' => false,]); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'tipo_id')->textInput(['type' => 'hidden', 'value' => $get['tipo']])->label(false) ?>
        </div>
        <div class="col-md-3">
            <div class="card p-3 m-3 text-center">
                <?php if ($model->tipo_id != 3 and $cliente_info): ?>
                    <img class='m-auto' src="/frontend/web/<?= $cliente_info ? $cliente_info['logo_url']: null ?>" width='80%'>
                <?php else: ?>
                    <img class='m-auto' src="/frontend/web/images/inversion.png" width='80%'>
                <?php endif ?>
            </div>
        </div>
        <div class="col-md-3">
            <?php echo $form->field($model, 'tipo_id')->dropDownList(ArrayHelper::map(\frontend\models\TiposImportes::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css', 'required' => 'required', 'disabled' => 'disabled']); ?>
            
            <?php if ($model->tipo_id == 3): ?>
                <?= $form->field($model, 'concepto')->textInput(['required' => 'required'])->label('Concepto') ?>
            <?php else: ?>
                <?= $form->field($model, 'servicio_extra_id')->dropDownList(ArrayHelper::map(\frontend\models\ServiciosExtras::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css', 'required' => 'required'])->label('Concepto'); ?>
            <?php endif ?>
        </div>

        <div class="col-md-4">
            <?php $colaboradores = \frontend\models\Colaboradores::find()->all(); ?>
            <div class="form-group">
                <label>Colaborador</label>
                <select class='form-control' name="colaborador_id" id="colaborador_select">
                    <option value="">Seleccionar...</option>
                    <?php foreach ($colaboradores as $colab): ?>
                        <option value="<?= $colab->id ?>" <?= $colaborador_id == $colab->id ? 'selected' : '' ?>><?= "$colab->nombre $colab->apellido" ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?php if ($model->tipo_id != 3): ?>
                <?= $form->field($model, 'concepto')->textInput([])->label('Comentario') ?>
                
            <?php endif ?>
            
            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <h4>Cuentas en el sistema</h4>
            <hr>
            </div>
        </div>
        <?php foreach ($cuentas as $c): ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?= $c->nombre ?></label>
                    <input type="number" name="cuenta[<?= $c->id ?>]" class="form-control cuenta" value='0'>
                </div>
            </div>
        <?php endforeach ?>
        <div class="col-md-6 dolab_amount_div" style='display: <?= !$colaborador_id ? 'none' :'' ?>;'>
            <div class="form-group">
                <label for="">Colaborador total</label>
                <input type="number" name='colaborador_amount' class="form-control cuenta" value='0'>
            </div>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'total')->textInput(['id' => 'total', 'style' => 'background:#f9fbfd;', 'required' => 'required', 'readonly' => 'readonly']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'fecha_pago')->textInput(['type' => 'date', 'value' => date("Y-m-d"), 'required' => 'required']) ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Registrar Importe', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
