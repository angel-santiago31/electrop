<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ReportsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reports-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-3">
        <?= $form->field($model, 'title') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'type')->dropDownList(['Sales' => 'Sales', 'Revenue' => 'Revenue'], ['prompt'=>'--Select--']) ?>
    </div>
      <br>
    <div class="btn btn-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span> Reset', ['reports/index'],['class' => 'btn btn-default']) ?>
    </div>

    <?php // $form->field($model, 'from_date') ?>

    <!-- <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'description') ?> -->

    <?php // echo $form->field($model, 'to_date') ?>

    <?php // echo $form->field($model, 'refers_to') ?>

    <?php ActiveForm::end(); ?>

</div>
