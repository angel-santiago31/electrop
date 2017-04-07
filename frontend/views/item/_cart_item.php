<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cart Items';
?>
<div class="site-about">
    <div class"container">
        <div class"col-sm-12">
             <?= $position->id ?>
             <?= $position->price ?>
             <?= $position->name ?>
             <?= $position->quantity ?>
        </div>
    </div>
</div>
