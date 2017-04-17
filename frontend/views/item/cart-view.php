<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Shopping Cart';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
      <div class="panel panel-default">
          <div class="panel-heading">
              <h1><i class="glyphicon glyphicon-shopping-cart"></i> <?= Html::encode($this->title) ?></h1>
          </div>
          <div class="panel-body">
            <div class="col-sm-12">
                <?php if (Yii::$app->user->isGuest): ?>
                        <h4>You currently have <?= $itemsCount ?> item(s) in your cart.</h4>
                    <?php endif ?>
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <h4><?= Yii::$app->user->identity->first_name ?>, you currently have <?= $itemsCount ?> item(s) in your cart.</h4>
                    <?php endif ?>
                    <br>
                    <div class"col-sm-10">
                        <p style="padding-left: 370px">price &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; quantity</p>
                    </div>
                    <hr>
                    <?php
                        $positions = \Yii::$app->cart->positions;
                        //var_dump($positions);
                        foreach($positions as $position) {
                            //echo "hello";
                            echo $this->render('_cart_item',['position' => $position]);
                            //var_dump($position);
                        }
                    ?>
                    <br>
                    <br>
                    <hr>
                    <h4 class="pull-right">Subtotal (<?= $itemsCount?> items): $ <?= $total?> </h4> <br><br>
                    <?= Html::a('<i class="glyphicon glyphicon-send"></i> Proceed to checkout', ['item/checkout'], ['class' => 'btn btn-default pull-right ']) ?>
              </div>
          </div>
      </div>
</div>
