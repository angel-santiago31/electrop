<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="col-sm-3">
        <?= $form->field($model, 'status')->dropDownList([Customer::STATUS_ACTIVE => 'Active', Customer::STATUS_DELETED => 'Inactive']) ?>
    </div>
     <div class="col-sm-9">
         <br>
        <div class="btn-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-refresh"></span> Reset', ['customer/index'],['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php //$form->field($model, 'id') ?>

    <?php //$form->field($model, 'email') ?>

    <?php // $form->field($model, 'password_hash') ?>

    <?php //$form->field($model, 'first_name') ?>

    <?php // $form->field($model, 'middle_name') ?>

    <?php // echo $form->field($model, 'fathers_last_name') ?>

    <?php // echo $form->field($model, 'mothers_last_name') ?>

    <?php // echo $form->field($model, 'date_of_birth') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>


    <?php ActiveForm::end(); ?>

</div>
