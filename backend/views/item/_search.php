<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-2">
        <?= $form->field($model, 'name') ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'active')->dropDownList([
                                                            1 => 'Active',
                                                            0 => 'Inactive'
                                                        ]) ?>
    </div>
    <div class="form-group">
        <br>
        <div class="btn-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-refresh"></span> Reset', ['item/index'],['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php //$form->field($model, 'picture') ?>

    <?php //$form->field($model, 'quantity_remaining') ?>

    <?php //$form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'gross_price') ?>

    <?php // echo $form->field($model, 'production_cost') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php ActiveForm::end(); ?>

</div>
