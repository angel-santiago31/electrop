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
            <div class="col-sm-10">
                <?= $form->field($model, 'nameSearch')->label(false) ?>
            </div>
            <div class="col-sm-2">
                <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Search', ['class' => 'btn btn-danger redCss', 'name' => 'search-button']) ?>
            </div>
        </div>

        <br>
    <?php ActiveForm::end(); ?>
</div>
