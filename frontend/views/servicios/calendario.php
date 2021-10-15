<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Servicios */

$clientes = \frontend\models\Clientes::find()->where(['in', 'status',  array(2,4,3)])->all();
$eventos = \frontend\models\Eventos::find()->all();

$this->title = 'Calendario';
?>
<div class="main-panel">

	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Calendario</h4>
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
						<a href="/frontend/web/servicios">Calendario</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Calendario</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<!-- <div class="card-header">
							<div class="card-title"><?//= Html::encode($this->title) ?></div>
						</div> -->
						<?= $this->render('_calendario', [
							'eventos' => $eventos,
							'clientes' => $clientes,
					    ]) ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
