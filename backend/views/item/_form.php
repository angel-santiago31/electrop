<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use backend\models\StickerSize;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */
/* @var $form yii\widgets\ActiveForm */

// print_r($model->errors);
?>

<div class="item-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'size')->dropDownList([
                                                                  StickerSize::SMALL => 'Small (2.7" x 4.0")',
                                                                  StickerSize::MEDIUM => 'Medium (3.7" x 5.5")',
                                                                  StickerSize::LARGE => 'Large (5.7" x 8.5")',
                                                                  StickerSize::EXTRA_LARGE => 'Extra Large (9.4" x 14.0")'
                                                                ]) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'quantity_remaining')->textInput()->label("Quantity Available") ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'gross_price')->textInput() ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'production_cost')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'item_category_id')->dropDownList([
                                                                                1 => 'Decals',
                                                                                2 => 'Wall',
                                                                                3 => 'Floor'
                                                                            ]) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'item_sub_category_id')->dropDownList([
                                                                                    1 => 'Jokes',
                                                                                    2 => 'Brands',
                                                                                    3 => 'Animals',
                                                                                    4 => 'Random'
                                                                                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'file')->fileInput()->label('Picture') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-saved"></span> Create' : '<span class="glyphicon glyphicon-pencil"></span> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
