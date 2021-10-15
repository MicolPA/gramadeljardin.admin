<?php 


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

// $fecha1 = date("Y-m-d",strtotime($model->fecha_nacimiento));
$fecha1 = new \DateTime($model->fecha_nacimiento);
$fecha2 =  new \DateTime(date("Y-m-d"));
$diff = $fecha1->diff($fecha2);


$servicios = new \common\models\Servicios();
$this->title = "$model->nombre $model->apellido";
 ?>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Colaboradores</h4>
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
                        <a href="/frontend/web/colaboradores">Colaboradores</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Perfil del colaborador</a>
                    </li>
                </ul>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="#" data-toggle="modal" data-target="#registrarImporteColaborador" class="btn btn-dark btn-sm" id='alert_demo_5'><i class="fas fa-plus mr-2"></i>Registrar Importe</a>
                    <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['editar', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']) ?>
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
                                <div class="card rounded m-3">
                                    <img src="/frontend/web/<?= $model->photo_url ?>" width='100%' class='rounded'>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-2 pt-3">
                                    <h2 class="font-weight-bold mb-2 h1 text-uppercase"><?= $model->nombre . ' ' . $model->apellido ?></h2>
                                    
                                    <p class="h4 font-weight-normal"><i class="fas fa-calendar-alt mr-1 text-dark"></i> <?= $diff->y ?> años <span class="badge-sm bg-warning text-white"><i class="fas fa-birthday-cake mr-1"></i> <?= $servicios->formatDate($model->fecha_nacimiento, 2) ?></span></p>
                                    <p class="h4 font-weight-normal"><i class="fas fa-clock mr-1 text-dark"></i> Ingresó el <?= $servicios->formatDate($model->fecha_ingreso, 1) ?> </p>
                                    <p class="h4 font-weight-normal"><i class="fas fa-envelope mr-1 text-dark"></i> <?= $model->email ? $model->email : "SIN REGISTRAR"; ?> </p>
                                    <p class="h4 font-weight-normal"><i class="fas fa-mobile mr-1 text-dark"></i> <?= $model->celular ? $model->celular : "SIN REGISTRAR" ?> </p>
                                    <p class="h4 font-weight-normal"><i class="fab fa-cc-visa mr-1 text-dark"></i> <?= $model->cuenta ? "$model->cuenta ($model->cuenta_banco)" : "SIN REGISTRAR" ?> </p>
                                    <div class="rounded w-75" style="min-height: 50px;">
                                        <p>
                                            <?= $model->resumen ?>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title float-left w-20 font-weight-bold">Historial de pagos</h4>
                                <a href="#" data-toggle="modal" data-target="#registrarImporteColaborador" class="btn btn-primary btn-round float-right btn-sm" id='alert_demo_5'><i class="fas fa-plus-circle mr-2"></i>Registrar Importe</a>
                        </div>
                        <div class="card-body">
                            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                <div class="tab-pane fade show pt-4 active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">

                                    <ol class="activity-feed">
                                        <?php if (count($pagos) > 0): ?>
                                            <?php foreach ($pagos as $pago): ?>
                                                <?php 
                                                    $text = "<span class='font-weight-bold'>". $pago->transaccion->servicioExtra->nombre . "</span>: Pago";
                                                    $text2 = $pago->transaccion->servicioExtra->nombre;
                                                 ?>
                                                <?php $class = $pago->tipo_id == 2 ? "danger" : 'success' ?>
                                                <li class="feed-item feed-item-<?= $class ?>">
                                                    <div class="col-md-8">
                                                        <time class="date" datetime="9-24"><?= $pago->fecha_pago ?></time>
                                                        <span class="text">
                                                          <?= $text . ' por concepto de: ' ?> 
                                                          <a href="/frontend/web/transacciones/editar?id=<?= $pago->transaccion->id ?>&view=/colaboradores/perfil?id=<?= $model->id ?>&tipo=<?= $pago->tipo_id ?>">
                                                              <?= $pago->transaccion->concepto ?>
                                                                  <?php if ($pago->transaccion->concepto): ?>
                                                                      <a class='text-warning' href="#" data-toggle="tooltip" data-placement="top" title="<?= $pago->transaccion->concepto ?>">
                                                                        <i class="ml-2 fas fa-comment-dots"></i>
                                                                      </a>
                                                                  <?php endif ?>
                                                              </a> 
                                                              <span class="float-right badge-pill badge-<?= $class ?>">RD$<?= number_format($pago->total) ?></span>
                                                      </span>
                                                    </div>
                                                </li>   
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <p class="text-center font-weight-bold h3"><?= "$model->nombre $model->apellido no tiene transacciones" ?></p>
                                        <?php endif ?>
                                    </ol>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registrarImporteColaborador" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Registrar Importe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php $model_t = new \frontend\models\Transacciones(); ?>
            <?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/frontend/web/transacciones/registrar']); ?>
            <?php $tipos = \frontend\models\TiposImportes::find()->where(['id' => 2])->all(); ?>
            <div class="form-group">
                <label for="">Tipo importe</label>
                <select name="tipo" id="" class="form-control" required>
                    <?php foreach ($tipos as $t): ?>
                        <option value="<?= $t->id ?>"><?= $t->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <input type="hidden" name="view" value="/colaboradores/perfil?id=<?= $model->id ?>">
            <input type="hidden" name="colaborador_id" value="<?= $model->id ?>">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary btn-sm']) ?>
          </div>
            <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>