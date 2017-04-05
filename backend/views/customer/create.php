<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = 'Create User';
//$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h1> <i class="glyphicon glyphicon-user"></i> <?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
