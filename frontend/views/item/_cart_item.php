<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Cart Items';
?>
<div class="site-about">
    <div class"container">
    <div class="row">
            <div class"col-sm-12">
                <!-- <?= $position->id ?> -->
                <div class="col-sm-1">
                    <img src="<?= '/electrop/backend/web/' . $position->picture ?>" class="stickerImg">
                </div>
                <br>
                <div class="col-sm-3">
                    <h5>
                        <?= $position->name ?>
                    </h5>
                </div>
                <div class="col-sm-2">
                    <h5>$ <?= $position->price ?> </h5> 
                </div>
                <div class="col-sm-2">
                    <h5> <?= $position->quantity ?> </h5> 
                </div>
                <div class="col-sm-4">
                    <?= Html::a('<i class="glyphicon glyphicon-remove"></i> Remove', ['item/cart-remove', 'id'=>$position->id], ['class' => 'btn btn-danger redCss']) ?>
                </div> 
            </div>
        </div>
    </div>
</div>
