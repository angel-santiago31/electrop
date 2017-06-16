<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;
/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'email')->textInput() ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'password_hash')->passwordInput() ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'firstName')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'middleName')->label('Middle Name (Optional)') ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'fathersLastName')->textInput() ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'mothersLastName')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'dateOfBirth')->widget(DatePicker::classname(), [
                                'options' => ['placeholder' => 'Enter End Date ...'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd-mm-yyyy'
                                ]
                                ]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'number')->widget(MaskedInput::className(),['mask' => '999-999-9999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "999-999-9999"]) ?>
                    </div>
                </div>
                 <h2><i class="glyphicon glyphicon-credit-card"></i> Payment Information</h2>
                <div class="row">
                    <div class="col-sm-4">
                    <?= $form->field($model, 'cardLastDigits')->widget(MaskedInput::className(),['mask' => '9999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "1234"])  ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'expDate')->widget(MaskedInput::className(),['mask' => '99/99', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "MM/YY"]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'cardType')->dropDownList([
                                                                            '' => '--Choose Option--',
                                                                            'Visa' => 'Visa',
                                                                            'Master card' => 'Master Card',
                                                                            'American Exppress' => 'American Exppress',
                                                                            ]) ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($model, 'nameOnCard')->textInput() ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'billingAddress')->textInput() ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'billingState')->dropDownList([
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
                    <div class="col-sm-4">
                        <?= $form->field($model, 'billingZipcode')->widget(MaskedInput::className(),['mask' => '99999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "12345"]) ?>
                    </div>

                </div>
                <br>
                <h2 ><i class="glyphicon glyphicon-plane"></i> Shipping Address</h2>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'streetName')->textInput() ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'aptNumber')->textInput() ?>
                   </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'zipcode')->widget(MaskedInput::className(),['mask' => '99999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "12345"]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-4">

                   </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'state')->dropDownList([
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
                <br>

    <?php //$form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'fathers_last_name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'mothers_last_name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'date_of_birth')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'age')->textInput() ?>

    <?php //$form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'status')->textInput() ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(/*$model->isNewRecord ? */'<i class="glyphicon glyphicon-plus"></i> Create'/* : 'Update'*/, ['class' => /*$model->isNewRecord ? */'btn btn-success'/* : 'btn btn-primary'*/]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
