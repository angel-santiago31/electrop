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
              <?= $form->field($newCard, 'card_last_digits')->widget(MaskedInput::className(),['mask' => '9999', 'clientOptions' =>['removeMaskOnSubmit']]) ?>

              <?= $form->field($newCard, 'card_type')->dropDownList([
                                                                  '' => '--Choose Option--',
                                                                  'Visa' => 'Visa',
                                                                  'Master card' => 'Master Card',
                                                                  'American Exppress' => 'American Exppress',
                                                                  ]) ?> 
          </div>
          <div class="col-sm-6">
              <?= $form->field($newCard, 'exp_date')->widget(MaskedInput::className(),['mask' => '99/99', 'clientOptions' =>['removeMaskOnSubmit']])->textInput(['placeholder' => "MM/YY"]) ?>
          </div>
      </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-send"></i> Create', ['class' => 'btn btn-success  pull-right']) ?>
        <br>
    </div>

    <?php ActiveForm::end(); ?>
</div>
