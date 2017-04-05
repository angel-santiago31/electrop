<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->email;
//$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h1><i class="glyphicon glyphicon-user"></i> <?= Html::encode($this->title) ?></h1>
        </div> 
        <div class="panel-body">
            <p>
                <?php //Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-floppy-remove"></i> Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
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
                        //'email:email',
                        //'password_hash',
                        'first_name',
                        'middle_name',
                        'fathers_last_name',
                        'mothers_last_name',
                        'date_of_birth',
                        'age',
                        //'auth_key',
                        //'password_reset_token',
                        //'status',
                        [
                            'attribute' => 'Status',
                            'value' => function ($model) {
                                return ($model->status === Customer::STATUS_ACTIVE)?
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
