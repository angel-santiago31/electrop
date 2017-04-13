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

    <?= $form->field($model, 'refers_to')->textInput(['maxlength' => true])->label('Grouped By')->dropDownList([ '1' => 'No Group', '2' => 'Floor', '3' => 'Wall', '4' => 'Decals'],['prompt'=>'--Select--']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
