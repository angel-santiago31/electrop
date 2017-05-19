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
              <?= $form->field($newAddress, 'street_name')->textInput() ?>

              <?= $form->field($newAddress, 'apt_number')->textInput() ?>
          </div>
          <div class="col-sm-6">
              <?= $form->field($newAddress, 'zipcode')->widget(MaskedInput::className(),['mask' => '99999', 'clientOptions' =>['removeMaskOnSubmit']]) ?>
              
              <?= $form->field($newAddress, 'state')->dropDownList([
                                                                  '' => '--Choose Option--',
                                                                  'AK' => 'AK',
                                                                  'AL' => 'AL',
                                                                  'AR' => 'AR',
                                                                  'AZ' => 'AZ',
                                                                  'CA' => 'CA',
                                                                  'CO' => 'CO',
                                                                  'CT' => 'CT',
                                                                  'DC' => 'DC',
                                                                  'DE' => 'DE',
                                                                  'FL' => 'FL',
                                                                  'GA' => 'GA',
                                                                  'HI' => 'HI',
                                                                  'IA' => 'IA',
                                                                  'ID' => 'ID',
                                                                  'IL' => 'IL',
                                                                  'IN' => 'IN',
                                                                  'KS' => 'KS',
                                                                  'KY' => 'KY',
                                                                  'LA' => 'LA',
                                                                  'MA' => 'MA',
                                                                  'MD' => 'MD',
                                                                  'ME' => 'ME',
                                                                  'MI' => 'MI',
                                                                  'MN' => 'MN',
                                                                  'MO' => 'MO',
                                                                  'MS' => 'MS',
                                                                  'MT' => 'MT',
                                                                  'NC' => 'NC',
                                                                  'ND' => 'ND',
                                                                  'NE' => 'NE',
                                                                  'NH' => 'NH',
                                                                  'NJ' => 'NJ',
                                                                  'NM' => 'NM',
                                                                  'NV' => 'NV',
                                                                  'NY' => 'NY',
                                                                  'OH' => 'OH',
                                                                  'OK' => 'OK',
                                                                  'OR' => 'OR',
                                                                  'PA' => 'PA',
                                                                  'PR' => 'PR',
                                                                  'RI' => 'RI',
                                                                  'SC' => 'SC',
                                                                  'SD' => 'SD',
                                                                  'TN' => 'TN',
                                                                  'TX' => 'TX',
                                                                  'UT' => 'UT',
                                                                  'VA' => 'VA',
                                                                  'VT' => 'VT',
                                                                  'WA' => 'WA',
                                                                  'WI' => 'WI',
                                                                  'WV' => 'WV',
                                                                  'WY' => 'WY',
                                                                  ]) ?>
          </div>
      </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-send"></i> Create', ['class' => 'btn btn-success  pull-right']) ?>
        <br>
    </div>

    <?php ActiveForm::end(); ?>
</div>
