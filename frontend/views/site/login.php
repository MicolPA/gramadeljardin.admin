<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login mt-5">

    <div class="row mt-5 pt-5">
        
        <div class="col-lg-6 m-auto card mt-5 pt-4 pb-4">
            <div class="text-center">
                <img src="/frontend/web/images/logo.png" width='200px'>
                <p class=" mt-2"><small class="font-weight-bold">Bienvenid@ al sistema de gestión de <?= Yii::$app->params['app_name'] ?></small></p>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Nombre de usuario') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
