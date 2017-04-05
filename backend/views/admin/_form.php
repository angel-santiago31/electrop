<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'email')->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'password_hash')->passwordInput(['value' => ''])->label('Password') ?>
            </div>
        </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-plus"></span> Create' : '<span class="glyphicon glyphicon-pencil"></span> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
