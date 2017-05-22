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

$select;

$this->title = 'Checkout';
?>

<?php 
    $card_selected = '';
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
        <div class="panel-heading">
            <h3>Select your payment method</h3>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                    'dataProvider' => $cards,
                    'id' => 'grid',
                    'columns' => [
                        'card_last_digits',
                        'exp_date',
                        'card_type',
                        [
                            'header' => 'Select',
                            'class' => 'yii\grid\RadioButtonColumn',
                            'radioOptions' => function($model, $key, $index, $column) {
                                return [ 'value' => $model->card_last_digits ];
                            }
                        ]
                    ],
                ]) 

                ?>
        </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Select the shipping address</h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
                <?php echo $form->field($model, 'shipping_address')->dropDownList(
                                        $value,
                                        ['prompt'=>' -- Select --'])->label(false); ?>
                <?php echo $form->field($model, 'payment_method')->hiddenInput(['id' => 'payment_field'])->label(false); ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-check-circle"></i> Confirm Order', ['class' => 'btn btn-primary btn-danger redCssConfirmButton center-block', 'id' => 'submit-order', 'name' => 'Submit Order']) ?>
            </div>
            <?php $form = ActiveForm::end(); ?>
        </div>
    </div>
  </div>
 
</div>


