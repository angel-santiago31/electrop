<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Shopping Cart';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class"container">
        <div class"col-sm-12">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr>
            <br>
            <h4>Your items in cart: <?= $itemsCount ?>  </h4>
            <br>
            <br>
            <?php
                $positions = \Yii::$app->cart->positions;
                //var_dump($positions); 
                foreach($positions as $position) {
                    //echo "hello";
                    echo $this->render('_cart_item',['position' => $position]);
                    //var_dump($position);
                }
            ?>
            <hr>
            <h4 class="pull-right">Subtotal (<?= $itemsCount?> item): $ <?= $total?> </h4>
            <br>
            <br>
            <br>
            <?= Html::Button('Proceed to Checkout',['class' => 'submit pull-right'])?> 
        </div>
    </div>
</div>