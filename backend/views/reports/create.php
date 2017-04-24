<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Reports */

$this->title = 'Create Report';
// $this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h1> <i class="glyphicon glyphicon-file"></i> <?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
        </div>
    </div>
</div>
