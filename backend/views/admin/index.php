<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Admin;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-12">
    <div class"container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="jumbotron">
                    <h1><?= '<span class="glyphicon glyphicon-user"></span> ' . Html::encode($this->title)?></h1>
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
                            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Create Admin', ['create'], ['class' => 'btn btn-success pull-right']) ?>
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
                        //'auth_key',
                        //'password_hash',
                        //'password_reset_token',
                        'email:email',
                        [
                            'attribute' => 'Status',
                            'value' => function ($model) {
                                return ($model->status === Admin::STATUS_ACTIVE) ? 'Active' : 'Inactive';
                            },
                        ],
                        //'status',
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
