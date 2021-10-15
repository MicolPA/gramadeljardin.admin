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

           <div class="row">
               <?php foreach ($dataProvider->query->all() as $model): ?>
                    <div class="col-md-3 div-colab">
                        <a href="/frontend/web/colaboradores/perfil?id=<?= $model->id ?>">
                            <div class="card">
                                <div class='border-radius rounded' style="background-image:url(/frontend/web/<?= $model->photo_url ?>);height:300px;background-position: center;background-size: cover;">
                                    <div class="div-gradient position-bottom">
                                        <p class="text-center text-white font-weight-bold"><?= "$model->nombre $model->apellido" ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
                <div class="col-md-3 colab-plus">
                    <a class="text-gray" href="/frontend/web/colaboradores/registrar">
                        <div class='border-radius rounded' style="background: #f2f2f2;justify-content: center; display: flex;align-items: center;height:300px;">
                                <i class="fas fa-plus display-1"></i>
                        </div>
                    </a>
                </div>
           </div>
        </div>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        
    </div>


</div>
