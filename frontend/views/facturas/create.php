<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Clientes */

$view = $w_client ? '_form' : '_form_without_client';

$this->title = 'Registrar Factura';
?>
<div class="main-panel">

	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Facturas</h4>
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
						<a href="/frontend/web/facturas">Facturas</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Registro de facturas</a>
					</li>
				</ul>
			</div>
    		<?php $form = ActiveForm::begin(); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title"><?= Html::encode($this->title) ?></div>
							</div>
							<?= $this->render("$view", [
						        'form' => $form,
						        'model' => $model,
            					'w_client' => $w_client,
            					'cliente_id' => $cliente_id,
						    ]) ?>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Detalle</div>
							</div>
							<?= $this->render('_form_details', [
						        'model' => $model,
						    ]) ?>
							
						</div>
					</div>
				</div>
   	 		<?php ActiveForm::end(); ?>
		</div>
	</div>


</div>
