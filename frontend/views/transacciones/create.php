<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transacciones */

$this->title = 'Registrar Transacción';
$this->params['breadcrumbs'][] = ['label' => 'Transacciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Transacciones</h4>
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
						<!-- <a href="/frontend/web/clientes">Clientes</a> -->
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<!-- <a href="#">Registro de clientes</a> -->
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title"><?= Html::encode($this->title) ?></div>
						</div>
						<?= $this->render('_form', [
					        'model' => $model,
            				'cuentas' => $cuentas,
					        'cliente_info' => $cliente_info,
            				'colaborador_id' => $colaborador_id,
					    ]) ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

