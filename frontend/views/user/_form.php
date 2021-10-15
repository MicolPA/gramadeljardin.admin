<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <label>Clave</label>
        <input type="password" name="password" class="form-control" placeholder="Contraseña" value="000000000">
    </div>

    <!-- <?//= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?> -->

    <!--<?//= $form->field($model, 'role_id')->textInput() ?>

    <?//= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'status')->textInput() ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <?//= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?> -->

    <div class="form-group text-right mt-4 mb-5">
        <?= Html::submitButton('Guardar cambios', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
