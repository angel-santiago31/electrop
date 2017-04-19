<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Reports */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reports-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->dropDownList(['Sales' => 'Sales', 'Revenue' => 'Revenue'],['prompt'=>'--Select--']); ?>


    <?= $form->field($model, 'from_date')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter Start Date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'startView'=>'year',
        'minViewMode'=>'days',
        'format' => 'yyyy-mm-dd'
    ]
]) ?>

    <?= $form->field($model, 'to_date')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter End Date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
]) ?>

    <?= $form->field($model, 'refers_to')->textInput(['maxlength' => true])->label('Grouped By')->dropDownList([ 'No Group' => 'No Group', '1' => 'Decals', '2' => 'Wall', '3' => 'Floor', '4' => 'By Item ID'], ['id' => 'refers_to', 'prompt'=>'--Select--']); ?>

    <div id="itemIdField">
        <?= $form->field($model, 'item_id')->textInput()->dropDownList([$itemsList], ['prompt'=>'--Items--']); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-send"></i> Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
