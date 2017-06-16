<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use kartik\datetime\DateTimePicker;
use backend\models\Item;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Reports */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reports-form">

    <?php $form = ActiveForm::begin(); ?>

      <div class="row">
          <div class="col-sm-3">
              <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-sm-2">
              <?= $form->field($model, 'type')->dropDownList(['Sales' => 'Sales', 'Revenue' => 'Revenue'], ['prompt'=>'--Select--']); ?>
          </div>
          <div class="col-sm-3">
              <?= $form->field($model, 'from_date')->widget(DateControl::classname(), [
                      'displayFormat' => 'php:d/M/Y',
                      'type' => DateControl::FORMAT_DATE
                  ]);
              ?>
          </div>
          <div class="col-sm-3">
              <?= $form->field($model, 'to_date')->widget(DateControl::classname(), [
                      'displayFormat' => 'php:d/M/Y',
                      'type' => DateControl::FORMAT_DATE
                  ]);
              ?>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
          </div>
          <div class="col-sm-2">
                <?= $form->field($model, 'refers_to')->textInput(['maxlength' => true])->label('Grouped By')
                         ->dropDownList([
                              'All' => 'All',
                              '1' => 'Decals',
                              '2' => 'Wall',
                              '3' => 'Floor',
                              '4' => 'By Item'],
                               [
                                 'id' => 'refers_to',
                                 'prompt'=>'--Select--'
                               ]);
                ?>
          </div>
          <div class="col-sm-3">
              <div id="itemIdField">
                  <?= $form->field($model, 'item_selected')->dropDownList(ArrayHelper::map(Item::find()
                                                           ->select(['item_id','name'])->asArray()->all(),'item_id','name'), ['prompt'=>'--Select--']);?>
              </div>
          </div>
      </div>















    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-send"></i> Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
