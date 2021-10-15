<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ColaboradoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colaboradores';
$this->params['breadcrumbs'][] = $this->title;
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
                        <a href="#">Listado de Colaboradores</a>
                    </li>
                </ul>
                <div class="ml-md-auto py-2 py-md-0">
                    <?= Html::a('<i class="fas fa-plus-circle mr-2"></i> Nuevo', ['registrar'], ['class' => 'btn btn-secondary btn-round']) ?>
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
                            'attribute' => 'nombre',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $view =  Html::a("$data->nombre $data->apellido", ['perfil', 'id' => $data->id], []);
                                return "$view";
                            },
                        ], 
                       
                        [
                            'label' => '',
                            'format' => 'raw',
                            'value' => function($data){
                                $url = '"/Colaboradores/perfil?id='. $data->id .'"';
                                $btn = "<a href='javascript:addImporte($data->id, $url)' class='badge bg-primary text-white btn-round btn-sm'>Registrar Importe</a>";

                                return $btn;
                            }
                        ],
                        // 'representante_telefono',
                        //'representante_correo',
                        //'importe_base',
                        //'fecha_comienzo',
                        //'tiempo_estimado',
                        //'status',
                        'fecha_ingreso',
                        [
                            'label' => '',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $view =  Html::a('<i class="fas fa-eye text-primary mr-2"></i>', ['perfil', 'id' => $data->id], []);
                                $update =  Html::a('<i class="fas fa-pencil-alt text-primary mr-2"></i>', ['editar', 'id' => $data->id], []);
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
