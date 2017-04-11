<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\model */

$this->title = $model->first_name . ' ' . $model->fathers_last_name;
$this->params['breadcrumbs'][] = ['label' => 'models', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';  
?>
<div class="customer-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
