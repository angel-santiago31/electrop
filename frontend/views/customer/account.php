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

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $items = [
        [
           'label'=>'<i class="glyphicon glyphicon-user"></i> User',
           'content'=> $this->render('_user', ['model' => $model,]),
           'active'=>true,
           //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/default/solicitar-transcripcion'])],
        ],
        [
           'label'=>'<i class="fa fa-phone"></i> Phone',
           'content'=> $this->render('_phone', ['phone' => $phone, 'id' => $model->id]),
           'active'=>false,
           //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/default/solicitar-transcripcion'])],
        ],
        [
           'label'=>'<i class="fa fa-credit-card"></i> Payment',
           'content'=> $this->render('_paymentMethod', ['payment_method' => $payment_method, 'id' => $model->id]),
           'active'=>false,
           //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/default/solicitar-transcripcion'])],
        ],
        [
           'label'=>'<i class="fa fa-plane"></i> Shipping',
           'content'=> $this->render('_shippingAddress', ['shipping_address' => $shipping_address, 'id' => $model->id]),
           'active'=>false,
           //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/default/solicitar-transcripcion'])],
        ],
    ];

?>

<div class="container">
  <div class="col-sm-12">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="text-center"><?php echo 'Welcome ' . Yii::$app->user->identity->first_name . '!'; ?> </h1>
            <h4 class="text-center">Here you can view and update your account information.</h4>
          </div>
      </div>
  </div>
  <div class="col-sm-6">
      <div class="panel panel-default">
          <div class="panel-heading text-center">
              Account Details
          </div>
          <div class="panel-body">
              <?php
                  echo TabsX::widget([
                      'items'=>$items,
                      'position'=>TabsX::POS_ABOVE,
                      'encodeLabels'=>false
                  ]);
              ?>
          </div>
      </div>
  </div>
  <div class="col-sm-6">
      <div class="panel panel-default">
          <div class="panel-heading" style="text-align:center">
              Order History
          </div>
          <div class="panel-body">
              You currently have have no orders in your history.
          </div>
      </div>
  </div>
</div>
