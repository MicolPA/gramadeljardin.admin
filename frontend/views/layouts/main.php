<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


if (Yii::$app->user->isGuest) {
    return Yii::$app->response->redirect(['/site/login']);
}else{
}

AppAsset::register($this);

$user = Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/frontend/web/images/favicon.png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | <?= Yii::$app->params['app_name'] ?></title>
    <script src="/frontend/web/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/frontend/web/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="preloader">
    <div data-loader="circle-side"></div>
</div><!-- /Preload -->
<style>
    
</style>

<div class="wrapper">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">
            
            <a href="/" class="logo">
                <img src="/frontend/web/images/logo-white.png" alt="navbar brand" class="navbar-brand" width="110px">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <span class="h2"><i class="icon-menu"></i></span>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
            
            <div class="container-fluid">
                <!-- <div class="collapse" id="search-nav">
                    <form class="navbar-left navbar-form nav-search mr-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pr-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" placeholder="Search ..." class="form-control">
                        </div>
                    </form>
                </div> -->
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item toggle-nav-search hidden-caret">
                        <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                   
                    <li class="nav-item dropdown hidden-caret">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="notification">4</span>
                        </a> -->
                        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                            <li>
                                <div class="dropdown-title">You have 4 new notification</div>
                            </li>
                            <li>
                                <div class="notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    New user registered
                                                </span>
                                                <span class="time">5 minutes ago</span> 
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Rahmad commented on Admin
                                                </span>
                                                <span class="time">12 minutes ago</span> 
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img"> 
                                                <img src="/frontend/web/images/profile2.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Reza send messages to you
                                                </span>
                                                <span class="time">12 minutes ago</span> 
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Farrah liked Admin
                                                </span>
                                                <span class="time">17 minutes ago</span> 
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                        </a>
                        <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                            <div class="quick-actions-header">
                                <span class="title mb-1">Quick Actions</span>
                                <span class="subtitle op-8">Shortcuts</span>
                            </div>
                            <div class="quick-actions-scroll scrollbar-outer">
                                <div class="quick-actions-items">
                                    <div class="row m-0">
                                    
                                        <a class="col-6 col-md-4 p-0" href="/frontend/web/clientes/registrar">
                                            <div class="quick-actions-item bg-warning text-white">
                                                <i class="fas fa-user-plus text-white"></i>
                                                <span class="text">Agregar Cliente</span>
                                            </div>
                                        </a>
                                        
                                        <a class="col-6 col-md-4 p-0" href="/frontend/web/facturas/registrar">
                                            <div class="quick-actions-item text-white bg-secondary">
                                                <i class="fas fa-receipt text-white"></i>
                                                <span class="text">Registrar Factura</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="/frontend/web/facturas-generadas" target="_blank">
                                            <div class="quick-actions-item text-white bg-info">
                                                <i class="fas fa-folder text-white"></i>
                                                <span class="text">Ver Facturas Generadas</span>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                   
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">           
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <!-- <div class="avatar-sm float-left mr-2"> -->
                        <!-- <i class="fas fa-user"></i> -->
                    <!-- </div> -->
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <span class="h4 mb-0"><?= "$user->first_name $user->last_name" ?></span>
                                <span class="h5 font-weight-bold">Administración</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <!-- <li>
                                    <a href="#profile">
                                        <span class="link-collapse">Mi perfil</span>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="/frontend/web/site/logout">
                                        <span class="link-collapse">Cerrar sesión</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-info">
                    <!-- <li class="nav-item active">
                        <a href="/" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </li> -->
                    <!-- <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Secciones</h4>
                    </li> -->
                    <li class="nav-item <?= strpos(Yii::$app->request->url, 'clientes') ? 'active' : '' ?>">
                        <a href="/frontend/web/clientes/">
                            <i class="fas fa-users"></i>
                            <p>Clientes</p>
                        </a>
                        
                    </li>
                    
                   
                    <li class="nav-item <?= strpos(Yii::$app->request->url, 'facturas') ? 'active' : '' ?>">
                        <a href="/frontend/web/facturas">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <p>Facturas</p>
                        </a>
                    </li>
                     <li class="nav-item <?= strpos(Yii::$app->request->url, 'user') ? 'active' : '' ?>">
                        <a data-toggle="collapse" href="#users">
                            <i class="far fa-user"></i>
                            <p>Usuarios</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="users">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/frontend/web/user/">
                                        <span class="sub-item">Listado</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/frontend/web/site/signup">
                                        <span class="sub-item">Crear</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="mx-4 mt-2">
                        <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a> 
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->


    <div class="">
        <?= $content ?>
    </div>

    <div class="modal fade" id="registrarImporteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Registrar Importe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php $model = new \frontend\models\Transacciones(); ?>
            <?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/frontend/web/transacciones/registrar']); ?>
            <?php $tipos = \frontend\models\TiposImportes::find()->all(); ?>
            <div class="form-group">
                <label for="">Tipo importe</label>
                <select name="tipo" id="" class="form-control" required>
                    <option value="">Seleccionar...</option>
                    <?php foreach ($tipos as $t): ?>
                        <option value="<?= $t->id ?>"><?= $t->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <?php $clientes = \frontend\models\Clientes::find()->orderBy(['date' => SORT_DESC])->all(); ?>
            <div class="form-group">
                <label for="">Cliente</label>
                <select name="cliente" id="" class="form-control">
                    <option value="">Seleccionar...</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c->id ?>"><?= $c->empresa ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <input type="hidden" name="view" value="/transacciones">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary btn-sm']) ?>
          </div>
            <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>


</div>

<?php if(Yii::$app->session->hasFlash('success')):?>
    <?php
    $msj = Yii::$app->session->getFlash('success');
    echo '<script type="text/javascript">';
    echo "setTimeout(function () { displayNotification('Correcto','$msj','fas fa-check-circle');";
    echo '}, 1000);</script>';
    ?>
<?php endif; ?>  

<!-- <footer class="footer mt-4">
    <div class="container">
        <p class="text-center">&copy; <?//= Html::encode(Yii::$app->name) ?> MICODE <?= date('Y') ?></p>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
