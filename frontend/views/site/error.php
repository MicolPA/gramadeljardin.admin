<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="main-panel">
    <div class="content">

        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <div class="alert alert-danger">
                        <?= nl2br(Html::encode($message)) ?>
                    </div>

                    <?php   

                        print_r($exception);
                     ?>

                    <p>
                        The above error occurred while the Web server was processing your request.
                    </p>
                    <p>
                        Please contact us if you think this is a server error. Thank you.
                    </p>
                </div>
            </div>
        </div>  

    </div>
</div>
