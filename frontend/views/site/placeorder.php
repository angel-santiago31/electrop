<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\sidenav\SideNav;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use kartik\tabs\TabsX;
use yii\grid\GridView;
use backend\models\Order;

$this->title = 'Checkout';
?>

<?php 
    $payment_method_items = [
        ['label'=>'<i class="fa fa-credit-card"></i> Payment Method',
        'content'=> $this->render('_paymentMethod', ['payment_method' => $payment_method, 'cards' => $cards,'model' => $model, 'id' => $model->id]),
        'active'=>false]
    ];

    $shipping_address_items = [
        ['label'=>'<i class="fa fa-credit-card"></i> Shipping Address',
        'content'=> $this->render('_shippingAddress', ['customer_shipping_address' => $customer_shipping_address]),
        'active'=>false]
    ];
?>

<div class="container">
  <div class="col-sm-12">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="text-center"><?php echo Yii::$app->user->identity->first_name . '`s Checkout!'; ?> </h1>
            <h4 class="text-center">Select a payment method and shipping address to proceed with your order.</h4>
          </div>
      </div>
  </div>
  <div class="col-sm-6">
    <div class="panel panel-default">
          <?php echo TabsX::widget([
                      'items'=>$payment_method_items,
                      'position'=>TabsX::POS_ABOVE,
                      'encodeLabels'=>false
                  ]);
            ?>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="panel panel-default">
          <?php echo TabsX::widget([
                      'items'=>$shipping_address_items,
                      'position'=>TabsX::POS_ABOVE,
                      'encodeLabels'=>false
                  ]);
            ?>
    </div>
  </div>
</div>