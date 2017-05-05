<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Admin;

/* @var $this yii\web\View */
/* @var $model common\models\AdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-2">
        <?= $form->field($model, 'id') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'status')->dropDownList([Admin::STATUS_ACTIVE => 'Active', Admin::STATUS_DELETED => 'Inactive'], ['prompt'=>'--Select--']) ?>
    </div>
      <br>
    <div class="btn btn-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span> Reset', ['admin/index'],['class' => 'btn btn-default']) ?>
    </div>

    <?php //$form->field($model, 'auth_key') ?>

    <?php //$form->field($model, 'password_hash') ?>

    <?php //$form->field($model, 'password_reset_token') ?>

    <?php //$form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php ActiveForm::end(); ?>

</div>
