<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Colaboradores */

$this->title = 'Registrar Colaboradores';
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
                        <a href="#">Edtar de Colaborador/a</a>
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
