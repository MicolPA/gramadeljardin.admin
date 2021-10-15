<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title = "Transacciones de $tarjeta->nombre";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Finanzas</h4>
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
                        <a href="/frontend/web/transacciones">Finanzas</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Historial de transacciones</a>
                    </li>
                </ul>
                <div class="ml-md-auto py-2 py-md-0">
                    <button type="button" class="btn btn-secondary btn-round" data-toggle="modal" data-target="#registrarImporteModal"><i class="fas fa-plus-circle mr-2"></i> Registrar Importe</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-dark bg-<?= $tarjeta->color ?>-gradient">
                        <div class="card-body bubble-shadow">
                            <!-- <img src="/frontend/web/images/visa.svg" height="12.5" alt="Visa Logo"> -->
                            <i class="<?= $tarjeta->icon ?> fa-2x mt-2"></i>
                            <h2 class="py-4 mb-0"><?= substr($tarjeta->numeracion, 0, 4) ?> **** **** <?= substr($tarjeta->numeracion, -4) ?></h2>
                            <div class="row">
                                <div class="col-6 pr-0">
                                    <h3 class="fw-bold mb-1 h4"><?= $tarjeta->representante_nombre ?></h3>
                                    <div class="text-small text-uppercase fw-bold op-8"><?= $tarjeta->nombre ?></div>
                                </div>
                                <div class="col-6 pl-0 text-right">
                                    <h3 class="fw-bold mb-1">RD$<?= number_format($tarjeta->dinero_total) ?></h3>
                                    <div class="text-small text-uppercase fw-bold op-8">Saldo</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Historial de transacciones</div>
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <?php foreach ($model as $pago): ?>
                                    <?php $class = $pago->tipo_id == 1 ? "success" : 'danger' ?>
                                    <li class="feed-item feed-item-<?= $class ?>">
                                        <div class="col-md-12">
                                            <time class="date" datetime="9-24"><?= $pago->fecha_pago ?></time>
                                            <?php 

                                                if ($pago->tipo_id == 3) {
                                                    $text = "<span class='font-weight-bold'>".$pago->tipo->nombre.":</span>";
                                                    $text2 = $pago->transaccion->concepto;
                                                }else{
                                                    $text = "<span class='font-weight-bold'>". $pago->cliente->empresa . "</span>: " . $pago->tipo->nombre;
                                                    $text2 = $pago->transaccion->servicioExtra->nombre;
                                                }

                                             ?>
                                            <span class="text"><?= $text ?> por concepto de <a href="/frontend/web/transacciones/editar?id=<?= $pago->id ?>&view=/transacciones&tipo=<?= $pago->tipo_id ?>&cliente=<?= $pago->cliente_id ?>"><?= $text2 ?></a> <span class="float-right badge-pill badge-<?= $class ?>">RD$<?= number_format($pago->total) ?></span> </span>
                                        </div>
                                    </li>   
                                <?php endforeach ?>
                            </ol>
                        </div>
                        <div class="col-md-12" style="text-align: right;">
                            <div class="">
                                <?php 
                                // display pagination
                                echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pagination,
                                    'options' => [
                                        'class' => 'pagination pg-primary float-left',

                                    ],
                                    'linkOptions' => ['class' => 'page-link'],
                                    'prevPageLabel' => false,
                                    'nextPageLabel' => false,

                                ]);
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        
    </div>


</div>

