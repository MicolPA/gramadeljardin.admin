<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title = 'Servicios Extras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Servicios Extras</h4>
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
                        <a href="/frontend/web/servicios-extras">Servicios Extras</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Listado de Servicios Extras</a>
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
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'nombre',
                        'precio',
                        
                        [
                            'label' => '',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $view =  Html::a('<i class="fas fa-eye text-primary mr-2"></i>', ['ver', 'id' => $data->id], []);
                                $update =  Html::a('<i class="fas fa-pencil-alt text-primary mr-2"></i>', ['editar', 'id' => $data->id], []);
                                $delete = Html::a('<i class="fas fa-trash text-danger mt-2"></i>', ['delete', 'id' => $data->id], [
                                    'data' => [
                                        'confirm' => '¿Está seguro/a que desea eliminar este registro?',
                                        'method' => 'post',
                                    ],
                                ]);
                                return "$update $delete";
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
