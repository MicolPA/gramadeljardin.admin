<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Anotacioness */

$this->title = "Anotaciones de $cliente->empresa";
?>
<div class="main-panel">

	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Anotaciones</h4>
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
						<a href="/frontend/web/anotaciones">Anotaciones</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Registro de Anotaciones</a>
					</li>
				</ul>

			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title font-weight-bold"><span class="text-primary"><?= Html::encode($this->title) ?></span> <?php if ($model->user_id == Yii::$app->user->identity->id): ?>
								 <a href="#" class="btn btn-primary btn-sm float-right text-white submit"><i class="fas fa-save mr-2"></i> Guardar</a>
							<?php endif ?></div>
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
