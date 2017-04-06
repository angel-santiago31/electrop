<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Home';
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <h1>FEATURED STICKERS</h1>
        </div>
    </div>
    <?= $this->render('_stickerListIndex', ['stickerList' => $stickerList]); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            Hi
        </div>
    </div>
</div>
