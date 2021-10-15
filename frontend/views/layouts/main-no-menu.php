<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Chad International</title>
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

<div class="">

    <div class="container">
        <?= $content ?>
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
