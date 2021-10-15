<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TarjetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarjetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Reportes</h4>
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
                        <a href="/frontend/web/tarjetas">Reportes</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Dashboard Reportes</a>
                    </li>
                </ul>
                
            </div>

             <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-info card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-analytics"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Ingresos</p>
                                        <h4 class="card-title"><?= number_format($data['ingresos']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-danger card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-hands-1"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Gastos</p>
                                        <h4 class="card-title"><?= number_format($data['gastos']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-warning card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-success"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Colaboradores</p>
                                        <h4 class="card-title"><?= number_format($data['colaboradores']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-success card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-success"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Ganancias</p>
                                        <h4 class="card-title"><?= number_format($data['ganancias']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Ingresos vs Ganancias <small>Últimos 6 meses</small></div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container2">
                                <?php echo $this->render('_chart_ganancias', ['importes' => $importes, 'importes_ganancias' => $importes_ganancias, 'meses' => $meses]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            	<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Importes <small>Últimos 6 meses</small></div>
						</div>
						<div class="card-body">
							<div class="chart-container2">
                                <?php  echo $this->render('_chart_importes_general', ['importes_ganancias' => $importes_ganancias,'importes' => $importes, 'meses' => $meses]); ?>
							</div>
						</div>
					</div>
				</div>
                
            </div>

        </div>


        
    </div>


</div>
