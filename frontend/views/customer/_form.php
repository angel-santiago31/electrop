<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */



?>

<h1><?= $model->first_name . ' ' . $model->fathers_last_name; ?></h1>

<div class="container" align="center"> 
                <div class="row">
            <div class="col-sm-12">
                <?php $form = ActiveForm::begin(['id' => 'customer-account-form']); ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'email')->textInput(['value' => $model->email]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'first_name')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'middle_name')->label('Middle Name (Optional)') ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'fathers_last_name')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'mothers_last_name')->textInput()?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'date_of_birth')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=
                            Html::submitButton('<i class="glyphicon glyphicon-pencil"></i> Change', [ 'value' => Url::to(['/customer/update-info']), 'class' => 'btn btn-danger redCss', 'name' => 'update-customer-info-button']);
                        ?>
                    </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
