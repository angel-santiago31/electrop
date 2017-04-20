<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
      <div class="row">
          <div class="col-sm-6">
              <?= $form->field($model, 'card_last_digits')->textInput() ?>

              <?= $form->field($model, 'card_type')->textInput() ?>
          </div>
          <div class="col-sm-6">
              <?= $form->field($model, 'exp_date')->textInput() ?>
          </div>
      </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-send"></i> Update', ['class' => 'btn btn-danger redCss pull-right']) ?>
        <br>
    </div>

    <?php ActiveForm::end(); ?>
</div>
