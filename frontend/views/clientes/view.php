<?php 


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = $model->empresa;
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
						<a href="#">Perfil del cliente</a>
					</li>
				</ul>
				<div class="ml-md-auto py-2 py-md-0">
            <?= Html::a('<i class="fas fa-plus mr-1"></i> Registrar Factura', ['facturas/registrar', 'cliente_id' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?>
            <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['editar', 'id' => $model->id], ['class' => 'btn btn-dark btn-sm']) ?>
            <?= Html::a('<i class="fas fa-trash text-white"></i>', ['delete', 'id' => $model->id], [
                    'data' => [
                        'confirm' => '¿Está seguro/a que desea eliminar este registro?',
                        'method' => 'post',
                    ], 'class' => 'btn btn-danger btn-sm'
                ]); ?>
        </div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="row">
							<div class="col-md-3">
								<div class="card p-3 m-3 ">
									<img src="/frontend/web/<?= $model->logo_url ? $model->logo_url : 'images/logo-goes-here.png' ?>" width='100%'>
								</div>
							</div>
							<div class="col-md-9">
								<div class="p-2 pt-4">
									<h2 class="font-weight-bold mb-2"><?= $model->empresa ?> </h2>
									<?php if ($model->dominio): ?>
										<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark mr-2"></i> <a href="https://<?= $model->dominio ?>" target='_blank'><?= $model->dominio ?></a></p>
									<?php endif ?>
									<p class="h4 font-weight-normal"><i class="fas fa-user mr-2"></i> <?= $model->representante_nombre ? $model->representante_nombre : "No registrado" ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-phone mr-2"></i> <?= $model->representante_telefono ? $model->representante_telefono : "No registrado"; ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-envelope mr-2"></i> <?= $model->representante_correo ? $model->representante_correo : 'No registrado' ?></p>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title float-left w-20 font-weight-bold">Información</h4>
								<?= Html::a('<i class="fas fa-plus mr-1"></i> Registrar Factura', ['facturas/registrar', 'cliente_id' => $model->id], ['class' => 'btn btn-warning btn-sm float-right']) ?>
						</div>
						<div class="card-body">
							<ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-facturas-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-file-invoice-dollar mr-2"></i> Facturas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-anotaciones-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-sticky-note mr-2"></i> Anotaciones</a>
								</li>
								
							</ul>
							<div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
								
								<div class="tab-pane fade" id="pills-anotaciones-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">

									<div class="col-md-6">
										<div class=" card-round">
											<div class="card-body">
												<div class="card-title fw-mediumbold">Anotaciones de usuarios</div>
												<div class="card-list">
													<?php foreach ($users as $user): ?>
														<?php $anotacion = \frontend\models\Anotaciones::find()->where(['user_id' => $user->id, 'cliente_id' => $model->id])->one(); ?>
														<div class="item-list">
															<div class="">
																<a class="btn btn-info btn-round pt-3 pb-3 text-white"><i class="fas fa-user"></i></a>
															</div>
															<div class="info-user ml-3">
																<div class="h4 text-primary"><?= $user->first_name . " " . $user->last_name ?></div>
																<div class="h5"><b>Última modificación</b>: <?= $anotacion ? $anotacion['ultima_modificacion'] : 'no ha realizado anotaciones.' ?></div>
															</div>
															<?php if ($user->id == Yii::$app->user->identity->id): ?>
																<?php if ($anotacion): ?>
																	<a href="/frontend/web/anotaciones/ver?cliente_id=<?= $model->id ?>&id=<?= $anotacion->id ?>" class="btn btn-primary btn-round btn-sm pt-2 pb-2"><i class="fa fa-pen fa-sm"></i></a>
																	<?php else: ?>
																		<a href="/frontend/web/anotaciones/ver?cliente_id=<?= $model->id ?>" class="btn btn-primary btn-round btn-sm pt-2 pb-2"><i class="fa fa-plus fa-sm"></i></a>
																<?php endif ?>
															<?php else: ?>
																<?php if ($anotacion): ?>
																	<a href="/frontend/web/anotaciones/ver?cliente_id=<?= $model->id ?>&id=<?= $anotacion->id ?>" class="btn btn-primary btn-round btn-sm pt-2 pb-2"><i class="fas fa-eye fa-sm"></i></a>
																	<?php else: ?>
																<?php endif ?>
															<?php endif ?>
														</div>
													<?php endforeach ?>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane active" id="pills-facturas-nobd" role="tabpanel" aria-labelledby="pills-anotaciones-tab-nobd">
									<?php if (count($facturas) > 0): ?>
									<ol class="activity-feed">
										<?php foreach ($facturas as $factura): ?>
                    					<p><?= Html::a("<i class='fas fa-link mr-1'></i> $factura->asunto <i class='fas fa-external-link-alt fa-xs ml-2'></i>", ['facturas/ver', 'id' => $factura->id], ['target' => '_blank']) ?></p>
										<?php endforeach ?>
		              </ol>
		              <?php else: ?>
		              <p class="mt-4">No se han registrado facturas de este cliente.</p>	
									<?php endif ?>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

