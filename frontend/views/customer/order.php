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
$this->params['breadcrumbs'][] = ['label' => 'My Account', 'url' => Url::to(['customer/account', 'id' => $user])];
$this->params['breadcrumbs'][] = $this->title;
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
                      [
                          'label' => 'Card Number',
                          'attribute' => 'payment_method',
                      ],
                      'shipping_address',
                  ],
              ]) ?>

              <div class="container">
                <h4><label>Items in order:</label></h4>
              </div>

              <?php foreach($order_items as $sticker): ?>
                  <div class="col-sm-3">
                      <div class="panel panel-default">
                            <div class="panel-body">
                                <?php
                                    $post = Yii::$app->db->createCommand("SELECT picture FROM item WHERE item_id = '$sticker->item_id'")->queryOne();
                                    $path = Url::to('/electrop/backend/web/' . $post["picture"]);
                                ?>
                                <img src="<?= $path?>" class="stickerImg" />
                            </div>
                            <div class="panel-footer text-center">
                                <?php
                                    $post = Yii::$app->db->createCommand("SELECT name FROM item WHERE item_id = '$sticker->item_id'")->queryOne();
                                    $name = $post["name"];
                                ?>

                                Name: <?= Html::encode($name) ?>
                                <br><br>
                                Price Sold: $<?= Html::encode($sticker->price_sold)?>
                                <br><br>
                                Quantity in Order: <?= Html::encode($sticker->quantity_in_order) ?>
                                <br><br>
                                <div class="btn-group">
                                    <?= Html::a('<i class="glyphicon glyphicon-eye-open"></i> View details', ['/item/details', 'id' => $sticker->item_id], ['class' => 'btn btn-default align-center']) ?>
                                </div>
                            </div>
                      </div>
                  </div>
              <?php endforeach; ?>
        </div>
    </div>
</div>
