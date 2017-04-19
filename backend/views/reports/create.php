<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Reports */

$this->title = 'Create Reports';
// $this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                    'model' => $model,
                    'itemsList' => $itemsList
                ]) ?>
        </div>
    </div>
</div>
