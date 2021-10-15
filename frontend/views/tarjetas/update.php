<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tarjetas */

$this->title = 'Editar cuentas';
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Cuentas</h4>
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
						<a href="/frontend/web/tarjetas">Cuentas</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Editar cuenta</a>
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
					    ]) ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

