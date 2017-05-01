<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">
    <?php $form = ActiveForm::begin(['action' =>['site/stickers-search'], 'method' => 'post',]); ?>
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'name')->label("") ?>
            </div>
            <div class="col-sm-4">
            <br>
                <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Search', ['class' => 'btn btn-danger redCss', 'name' => 'search-button']) ?>
            </div>
        </div>

        <br>
    <?php ActiveForm::end(); ?>
</div>
