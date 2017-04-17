<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Home';
?>
<?php $images=['<img align:center src="/electrop/backend/web/uploads/cr1.jpg""/>','<img src="/electrop/backend/web/uploads/cr2.jpg">',];
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
