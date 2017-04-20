<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
      <div class="row">
          <div class="col-sm-6">
              <?= $form->field($model, 'email')->textInput() ?>

              <?= $form->field($model, 'first_name')->textInput() ?>

              <?= $form->field($model, 'middle_name')->textInput() ?>
          </div>
          <div class="col-sm-6">
              <?= $form->field($model, 'fathers_last_name')->textInput() ?>

              <?= $form->field($model, 'mothers_last_name')->textInput() ?>

              <?= $form->field($model, 'date_of_birth')->widget(DatePicker::classname(), [
                      'options' => ['placeholder' => 'Enter End Date ...'],
                      'pluginOptions' => [
                      'autoclose'=>true,
                      'format' => 'yyyy-mm-dd'
                      ]
                      ]) ?>
          </div>
      </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-send"></i> Update', ['class' => 'btn btn-danger redCss pull-right']) ?>
        <br>
    </div>

    <?php ActiveForm::end(); ?>
</div>
