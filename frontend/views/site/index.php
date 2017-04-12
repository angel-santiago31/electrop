<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Home';
?><?php $images=['<img  src="/electrop/backend/web/uploads/Blocked.jpg"/>','<img src="/electrop/backend/web/uploads/Firebreathing King.jpg""/>','<img src="/electrop/backend/web/uploads/Shady Owl.jpg"'];
 echo yii\bootstrap\Carousel::widget(['items'=>$images]); ?>
<hr>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <h1>FEATURED STICKERS</h1>
        </div>
    </div>
    <?= $this->render('_stickerListIndex', ['stickerList' => $stickerList]); ?>
    <div class="panel panel-default">
        <div class="panel-body text-center">
            What should we put here?
        </div>
    </div>
</div>
