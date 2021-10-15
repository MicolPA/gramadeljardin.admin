<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Anotaciones */

$this->title = 'Update Anotaciones: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anotaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anotaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
