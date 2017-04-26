<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use backend\models\Order;
use backend\models\Item;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = 'Order Receipt';
//$this->params['breadcrumbs'][] = ['label' => 'My Account', 'url' => Url::to(['customer/account', 'id' => $user])];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
              <h1><i class="glyphicon glyphicon-list-alt"></i> <?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
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
                      'shipper_company_name',
                      'tracking_number',
                  ],
              ]) ?>

              <?= GridView::widget([
                  'dataProvider' => $order_items,
                  'summary'=>'<h3>Items in Order:</h3>',
                  'columns' => [
                       [
                        'label' => 'Picture',
                        'format' => 'html',
                        'value' => function ($order_items) {
                            $post = Yii::$app->db->createCommand("SELECT picture FROM item WHERE item_id = '$order_items->item_id'")->queryOne();
                            $path = Url::to('/electrop/backend/web/' . $post["picture"]);
                            //  echo $path;
                            //  die(1);
                            return '<p style="text-align:center"><img src="' . $path . '" height="100" width="100"/></p>';
                        }
                      ],
                      [
                        'label' => 'Name',
                        'format' => 'html',
                        'value' => function ($order_items) {
                            $post = Yii::$app->db->createCommand("SELECT name FROM item WHERE item_id = '$order_items->item_id'")->queryOne();
                            // var_dump($post);
                            // die(2);
                            return $post["name"];
                        }
                      ],
                      //'item_id',
                      'price_sold',
                      'quantity_in_order',
                      [
                        'label' => 'More',
                        'format' => 'html',
                        'value' => function ($order_items) {
                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i> View Item Details', ['item/details', 'id' => $order_items->item_id], ['class' => 'btn btn-xs btn-danger redCss']);
                        }
                      ],
                  ],
              ]); ?>
        </div>
    </div>
</div>
