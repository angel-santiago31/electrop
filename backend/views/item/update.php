<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = 'Update Item: ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->item_id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container">
    <div class="panel panel-warning">
        <div class="panel-heading">
              <h1><?= '<span class="glyphicon glyphicon-file"></span> ' . Html::encode($this->title)?></h1>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
