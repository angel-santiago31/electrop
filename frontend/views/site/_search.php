<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'item_category_id')->dropDownList([
                                                                          1 => 'Decals',
                                                                          2 => 'Wall',
                                                                          3 => 'Floor',
                                                                        ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'item_sub_category_id')->dropDownList([
                                                                          1 => 'Jokes',
                                                                          2 => 'Brands',
                                                                          3 => 'Animals',
                                                                          4 => 'Random',
                                                                        ]) ?>
            </div>
        </div>
        <div class="form-group">
            <br>
            <div class="btn-group">
                <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Search', ['class' => 'btn btn-danger', 'name' => 'search-button']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-refresh"></span> Reset', ['site/stickers'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
