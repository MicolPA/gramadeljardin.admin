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
                <img src="/frontend/web/<?= $cliente_info ? $cliente_info['logo_url'] : 'images/inversion.png' ?>" width='80%'>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'tipo_id')->dropDownList(array('1' => 'Ingreso', '2' => 'Gasto'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css', 'required' => 'required', 'disabled' => 'disabled']); ?>
            <?php echo $form->field($model, 'servicio_extra_id')->dropDownList(ArrayHelper::map(\frontend\models\ServiciosExtras::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css', 'required' => 'required', 'disabled' => 'disabled']); ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <h4>Cuentas en el sistema</h4>
            <hr>
            </div>
        </div>
        <?php foreach ($cuentas as $c): ?>
            <?php 
                $total = \frontend\models\TransaccionesDetalle::find()->where(['transaccion_id' => $model->id, 'tarjeta_id' => $c->id])->one();
                $balance = $total ? $total['total'] : 0;
             ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?= $c->nombre ?></label>
                    <input type="number" name="cuenta[<?= $c->id ?>]" class="form-control cuenta" value="<?= $balance ?>" readonly>
                </div>
            </div>
        <?php endforeach ?>
        <div class="col-md-6">
            <?= $form->field($model, 'total')->textInput(['id' => 'total', 'style' => 'background:#f9fbfd;', 'required' => 'required', 'disabled' => 'disabled']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'fecha_pago')->textInput(['type' => 'date', 'value' => date("Y-m-d"), 'required' => 'required', 'disabled' => 'disabled']) ?>
        </div>

        
    </div>

    <?php ActiveForm::end(); ?>

</div>
