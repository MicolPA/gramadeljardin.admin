<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tarjetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarjetas-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-4">
    		<?= $form->field($model, 'representante_nombre')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-4">
    		<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
				<label class="form-label d-block">Icon</label>
				<div class="selectgroup selectgroup-secondary selectgroup-pills">
					<label class="selectgroup-item">
						<input type="radio" name="Tarjetas[icon]" value="fas fa-credit-card" class="selectgroup-input" <?= $model->icon == 'fas fa-credit-card' ? 'checked' : '' ?>>
						<span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-credit-card"></i></span>
					</label>
					<label class="selectgroup-item">
						<input type="radio" name="Tarjetas[icon]" value="fab fa-cc-visa" class="selectgroup-input" <?= $model->icon == 'fab fa-cc-visa' ? 'checked' : '' ?>>
						<span class="selectgroup-button selectgroup-button-icon"><i class="fab fa-cc-visa"></i></span>
					</label>
					<label class="selectgroup-item">
						<input type="radio" name="Tarjetas[icon]" value="fab fa-cc-mastercard" class="selectgroup-input" <?= $model->icon == 'fab fa-cc-mastercard' ? 'checked' : '' ?>>
						<span class="selectgroup-button selectgroup-button-icon"><i class="fab fa-cc-mastercard"></i></span>
					</label>
					<label class="selectgroup-item">
						<input type="radio" name="Tarjetas[icon]" value="fab fa-cc-apple-pay" class="selectgroup-input" <?= $model->icon == 'fab fa-cc-apple-pay' ? 'checked' : '' ?>>
						<span class="selectgroup-button selectgroup-button-icon"><i class="fab fa-cc-apple-pay"></i></span>
					</label>
				</div>
			</div>
    	</div>
    	
    </div>

    <div class="row">
    	<div class="col-md-4">
    		<?= $form->field($model, 'numeracion')->textInput(['type' => 'number']) ?>
    	</div>
    	<div class="col-md-4">
    		<?= $form->field($model, 'dinero_total')->textInput(['type' => 'number']) ?>
    	</div>
    	
    	<div class="col-md-4">
    		<div class="form-group">
				<label class="form-label">Color</label>
				<div class="row gutters-xs">
					<div class="col-auto">
						<label class="colorinput">
							<input name="Tarjetas[color]" type="checkbox" value="dark" class="colorinput-input" <?= $model->color == "dark" ? 'checked' : '' ?>>
							<span class="colorinput-color bg-dark"></span>
						</label>
					</div>
					<div class="col-auto">
						<label class="colorinput">
							<input name="Tarjetas[color]" type="checkbox" value="primary" class="colorinput-input" <?= $model->color == "primary" ? 'checked' : '' ?>>
							<span class="colorinput-color bg-primary"></span>
						</label>
					</div>
					<div class="col-auto">
						<label class="colorinput">
							<input name="Tarjetas[color]" type="checkbox" value="secondary" class="colorinput-input" <?= $model->color == "secondary" ? 'checked' : '' ?>>
							<span class="colorinput-color bg-secondary"></span>
						</label>
					</div>
					<div class="col-auto">
						<label class="colorinput">
							<input name="Tarjetas[color]" type="checkbox" value="info" class="colorinput-input" <?= $model->color == "info" ? 'checked' : '' ?>>
							<span class="colorinput-color bg-info"></span>
						</label>
					</div>
					<div class="col-auto">
						<label class="colorinput">
							<input name="Tarjetas[color]" type="checkbox" value="success" class="colorinput-input" <?= $model->color == "success" ? 'checked' : '' ?>>
							<span class="colorinput-color bg-success"></span>
						</label>
					</div>
					<div class="col-auto">
						<label class="colorinput">
							<input name="Tarjetas[color]" type="checkbox" value="danger" class="colorinput-input" <?= $model->color == "danger" ? 'checked' : '' ?>>
							<span class="colorinput-color bg-danger"></span>
						</label>
					</div>
					<div class="col-auto">
						<label class="colorinput">
							<input name="color" type="checkbox" value="warning" class="colorinput-input" <?= $model->color == "warning" ? 'checked' : '' ?>>
							<span class="colorinput-color bg-warning"></span>
						</label>
					</div>
				</div>
			</div>
    	</div>

    </div>


    <!-- <?//= $form->field($model, 'dinero_total')->textInput(['maxlength' => true]) ?> -->

    <div class="form-group mt-4">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
