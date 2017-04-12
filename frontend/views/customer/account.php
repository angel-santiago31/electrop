<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\sidenav\SideNav;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
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
          <div class="panel-heading" style="text-align:center">
              Account Details
          </div>
          <div class="panel-body">
                  <?= DetailView::widget([
                      'model' => $model,
                      'attributes' => [
                          'email:email',
                          'first_name',
                          'middle_name',
                          'fathers_last_name',
                          'mothers_last_name',
                          'date_of_birth',
                      ],
                  ]) ?>

                  <?= Html::button('<i class="glyphicon glyphicon-pencil"></i> Update', [ 'value' => Url::to(['update', 'id' => $model->id]), 'class' => 'btn btn-danger pull-right redCss', 'id' => 'updateInfo']); ?>
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
