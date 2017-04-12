<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\widgets\MaskedInput;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register:</p>

    <div class="row">
        <div class="col-sm-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'email')->textInput() ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'password')->passwordInput() ?>
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
                        <?= $form->field($model, 'dateOfBirth')->widget(MaskedInput::className(),['mask' => '99-99-9999', 'clientOptions' =>['removeMaskOnSubmit']]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'phoneNumber')->textInput() ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('<i class="glyphicon glyphicon-pencil"></i> Register', ['class' => 'btn btn-danger redCss', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
