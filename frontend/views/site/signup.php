<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Clientes</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/web/clientes">Clientes</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Registro de clientes</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><?= Html::encode($this->title) ?></div>
                        </div>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'email')->textInput([]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'first_name')->textInput([])->label('Nombre') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'last_name')->textInput([])->label('Apellido') ?>
                            </div>
                            
                            <div class="col-md-6">
                                <?= $form->field($model, 'password')->passwordInput(['type' => 'text', 'min' => 6])->label('Contraseña') ?>
                            </div> 
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Guardar Usuario', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

