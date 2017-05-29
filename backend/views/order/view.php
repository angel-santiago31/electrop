<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use backend\models\Order;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = 'Order Details';
// $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="col-sm-10">
    <div class="panel panel-info">
        <div class="panel-heading">
              <h1><i class="glyphicon glyphicon-list-alt"></i> <?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
              <p>
                  <!-- <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> Update Status', ['update', 'id' => $model->order_number], ['class' => 'btn btn-warning']) ?> -->
                  <?= Html::button('<i class="glyphicon glyphicon-pencil"></i> Update Status', [ 'value' => Url::to(['update', 'id' => $model->order_number]), 'class' => $model->isStatusShipped(), 'id' => 'updateOrderStatus']); ?>
                  <!-- <?= Html::a('Delete', ['delete', 'id' => $model->order_number], [
                      'class' => 'btn btn-danger',
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) ?> -->
              </p>

              <?= DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                      'order_number',
                      'order_date:dateTime',
                      'amount_stickers',
                      'total_price',
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
                      'customer_id',
                      'payment_method',
                      'shipping_address',
                      'shipper_company_name',
                      'tracking_number',
                  ],
              ]) ?>

              <?= GridView::widget([
                  'dataProvider' => $order_items,
                  'summary'=>'<h3>Order Items:</h3>',
                  'columns' => [
                      'item_id',
                      'price_sold',
                      'quantity_in_order',
                      [
                        'label' => 'More',
                        'format' => 'html',
                        'value' => function ($order_items) {
                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i> View Details', ['item/view', 'id' => $order_items->item_id], ['class' => 'btn btn-xs btn-info']);
                        }
                      ],
                  ],
              ]); ?>
        </div>
    </div>
  </div>
</div>
