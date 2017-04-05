<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = 'Add Item';
//$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
              <h1><?= '<span class="glyphicon glyphicon-inbox"></span> ' . Html::encode($this->title)?></h1>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
