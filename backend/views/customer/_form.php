<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-sm-4">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
                <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

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
