<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' Users';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">
  <div class="container">
    <div class="col-sm-10">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="jumbotron text-center">
                    <h1><i class="glyphicon glyphicon-user"></i><?= Html::encode($this->title) ?></h1>
                </div>
            </div>
            
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-9">
                        <?= $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                    <div class="col-sm-3">
                        <p>
                            <br>
                            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Create User', ['create'], ['class' => 'btn btn-success pull-right']) ?>
                            <br>
                        </p>
                    </div>
                </div>
                
                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'columns' => [
                                //['class' => 'yii\grid\SerialColumn'],

                                'id',
                                'email:email',
                                //'password_hash',
                                //'first_name',
                                //'middle_name',
                                // 'fathers_last_name',
                                // 'mothers_last_name',
                                // 'date_of_birth',
                                // 'age',
                                // 'auth_key',
                                // 'password_reset_token',
                                // 'status',
                                [
                                    'attribute' => 'Status',
                                    'value' => function ($model) {
                                        return ($model->status === Customer::STATUS_ACTIVE)?
                                            'Active' : 'Inactive';
                                    },
                                ],
                                'created_at:dateTime',
                                'updated_at:dateTime',

                                //['class' => 'yii\grid\ActionColumn'],
                                [
                                'label' => 'More',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i> View Details', ['view', 'id' => $model->id], ['class' => 'btn btn-xs btn-info', 'target' => '_blank']);
                                }
                                ],
                            ],
                        ]); ?>
            </div>
        </div>
      </div>
  </div>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    
</div>
