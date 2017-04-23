<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Order;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-2">
        <?= $form->field($model, 'order_number') ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'order_status')->dropDownList([Order::PENDING => 'Pending',
                                                                Order::VERIFIED => 'Verified',
                                                                Order::SHIPPED => 'Shipped',
                                                                Order::DELIVERED => 'Delivered',
                                                                Order::CANCELED => 'Canceled'], ['prompt'=>'--Select--']) ?>
    </div>
    <br>
    <div class="btn btn-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span> Reset', ['order/index'],['class' => 'btn btn-default']) ?>
    </div>

    <!-- <?= $form->field($model, 'order_date') ?> -->

    <!-- <?= $form->field($model, 'amount_stickers') ?>

    <?= $form->field($model, 'total_price') ?> -->

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'shipper_company_name') ?>

    <?php // echo $form->field($model, 'tracking_number') ?>

    <?php ActiveForm::end(); ?>

</div>
