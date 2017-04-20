<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Admin;

/* @var $this yii\web\View */
/* @var $model common\models\Admin */

$this->title = $model->email;
//$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
              <h1><?= '<span class="glyphicon glyphicon-user"></span> ' . Html::encode($this->title)?></h1>
        </div>
        <div class="panel-body">
            <p>
                <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Restore', ['restore', 'id' => $model->id], ['class' => $model->isActive]) ?>
                <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Delete', ['delete', 'id' => $model->id], [
                    'class' => $model->isInactive,
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                    'email:email',
                    //'status',
                    [
                        'attribute' => 'Status',
                        'value' => function ($model) {
                        return ($model->status === Admin::STATUS_ACTIVE)?
                                'Active' : 'Inactive';
                        },
                    ],
                    'created_at:dateTime',
                    'updated_at:dateTime',
                ],
            ]) ?>
        </div>
    </div>
</div>
