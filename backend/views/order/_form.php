<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Order;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_status')->dropDownList([ Order::PENDING => 'Pending',
                                                             Order::VERIFIED => 'Verified',
                                                             Order::SHIPPED => 'Shipped',
                                                             Order::DELIVERED => 'Delivered'
                                                           ]) ?>

    <!-- <?= $form->field($model, 'order_date')->textInput() ?>

    <?= $form->field($model, 'amount_stickers')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'shipper_company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tracking_number')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : '<i class="glyphicon glyphicon-send"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
