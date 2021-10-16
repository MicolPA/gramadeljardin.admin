<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Facturas';
$this->params['breadcrumbs'][] = $this->title;
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
                        <a href="#">Listado de facturas</a>
                    </li>
                </ul>
                <div class="ml-md-auto py-2 py-md-0">

                    <?= Html::a('<i class="fas fa-plus-circle mr-2"></i> Crear factura', ['registrar'], ['class' => 'btn btn-secondary btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-plus-circle mr-2"></i> Crear factura sin cliente', ['registrar', 'w_client' => 0], ['class' => 'btn btn-success btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-file mr-2"></i> Archivo de Facturas', ['/facturas-generadas', 'w_client' => 0], ['class' => 'btn btn-warning  btn-sm', 'target' => '_blank']) ?>
                </div>
            </div>

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => 'Mostrando <b>{count}</b> registros de <b>{totalCount}</b>',
                   // 'tableOptions' => ['class' => 'table'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        [
                            'attribute' => 'cliente_id',
                            'format' => 'raw',
                            'value' => function ($data) {
                                if (isset($data->cliente->empresa)) {
                                    $name = $data->cliente->empresa;
                                }else{
                                    $name = $data->cliente_nombre;
                                }
                                return Html::a($name, ['ver', 'id' => $data->id], ['target' => '_blank']);
                            },
                        ], 
                        [
                            'format' => 'raw',
                            'attribute' => 'asunto',
                        ],
                        
                        [
                            'label' => 'Tipo',
                            'attribute' => 'cotizacion',
                            'value' => function($data){
                                return $data->cotizacion == 1 ? "Cotización" : "Factura";
                            }
                        ],
                        [
                            'label' => 'Estado',
                            'format' => 'raw',
                            'attribute' => 'pagada',
                            'value' => function($data){
                                if ($data->pagada) {
                                    return "<b class='text-success'>Pagada</b>";
                                }else{
                                    $action = Html::a("<b class='text-warning'>Pendiente</b>", ['mark-as-paid', 'id' => $data->id], [
                                        'data' => [
                                            'confirm' => '¿Está seguro/a que desea marcar la factura como pagada?',
                                            'method' => 'post',
                                        ],
                                    ]);

                                    return $action;
                                }
                            }
                        ],

                        [
                            'label' => 'Fecha',
                            'attribute' => 'date',
                            'value' => function ($data) {
                                return date('d/m/Y', strtotime(str_replace('-','/', $data->date)));
                            },
                        ],

                        
                        [
                            'label' => '',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $view =  Html::a('<i class="fas fa-eye text-primary mr-2"></i>', ['ver', 'id' => $data->id], ['target' => '_blank']);
                                $update =  Html::a('<i class="fas fa-pencil-alt text-primary mr-2"></i>', ['editar', 'id' => $data->id, 'w_client' => $data->cliente_id ? 1 : 0], []);
                                $delete = Html::a('<i class="fas fa-trash text-danger mt-2"></i>', ['delete', 'id' => $data->id], [
                                    'data' => [
                                        'confirm' => '¿Está seguro/a que desea eliminar este registro?',
                                        'method' => 'post',
                                    ],
                                ]);
                                return "$view $update $delete";
                            },
                        ],  

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
        </div>
        </div>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        
    </div>


</div>
