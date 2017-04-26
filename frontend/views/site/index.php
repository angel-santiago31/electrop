<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Carousel;

$this->title = 'Electrop';
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/electrop/backend/web/uploads/icon.png']);
?>
<?php

    $images = [];

    foreach ($carousel as $sticker) {
        $path = Url::to('/electrop/backend/web/' . $sticker->picture);
        $image = [
                    'content' => '<p style="text-align:center"><img src="' . $path . '"/></p>',
                    'caption' => '<h2>' . $sticker->name . '</h2><p>' . $sticker->description . '</p>',
                    'options' => [],
                ];
        // $image = Html::img('/electrop/backend/web/' . $sticker->picture, ['class' => 'alignC']);
        array_push($images, $image);
    }
    echo Carousel::widget(['items' => $images]);
?>
<link rel="icon" href="/electrop/backend/web/uploads/icon.png">


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
