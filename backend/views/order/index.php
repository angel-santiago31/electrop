<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Order;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="col-sm-10">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="jumbotron text-center">
                    <h1><i class="glyphicon glyphicon-list-alt"></i> <?= Html::encode($this->title) ?></h1>
                </div>
            </div>
            <div class="panel-body">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <!-- <p>
                    <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
                </p> -->

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'order_number',
                        'customer_id',
                        'order_date:dateTime',
                        [
                            'attribute' => 'order_status',
                            'value' => function ($model) {
                                if ($model->order_status == Order::CANCELED) {
                                    return 'Canceled';
                                } else if ($model->order_status == Order::PENDING) {
                                    return 'Pending';
                                } else if ($model->order_status == Order::VERIFIED) {
                                    return 'Verified';
                                } else if ($model->order_status == Order::SHIPPED) {
                                    return 'Shipped';
                                }

                                return 'Delivered';
                            },
                        ],
                        [
                            'label' => 'Shipped By',
                            'attribute' => 'shipper_company_name'
                        ],
                        'tracking_number',
                        [
                            'label' => 'More',
                            'format' => 'html',
                            'value' => function ($model) {
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i> View Details', ['view', 'id' => $model->order_number], ['class' => 'btn btn-xs btn-info']);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
