<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">
    <?php $form = ActiveForm::begin(['action' =>['site/stickers'], 'method' => 'post',]); ?>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'item_category_id')->dropDownList([
                                                                          Item::DECALS => 'Decals',
                                                                          Item::WALL => 'Wall',
                                                                          Item::FLOOR => 'Floor',
                                                                        ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'item_sub_category_id')->dropDownList([
                                                                          Item::JOKES => 'Jokes',
                                                                          Item::BRANDS => 'Brands',
                                                                          Item::ANIMALS => 'Animals',
                                                                          Item::RANDOM => 'Random',
                                                                        ]) ?>
            </div>
        </div>
        <div class="form-group">
            <br>
            <div class="btn-group">
                <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Search', ['class' => 'btn btn-danger redCss', 'name' => 'search-button']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-refresh"></span> Reset', ['site/stickers'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
