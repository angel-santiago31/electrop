<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Admin */

$this->title = 'Update Admin: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container">
  <div class="col-sm-10">
    <div class="panel panel-warning">
        <div class="panel-heading">
              <h1><?= '<span class="glyphicon glyphicon-user"></span> ' . Html::encode($this->title)?></h1>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
  </div>
</div>
