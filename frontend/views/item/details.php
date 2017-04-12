<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = 'Product Details';
//$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
  
  <div class="col-sm-6 col-xs-push-1">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h1><?= Html::encode($model->name) ?></h1>
        </div>
        <div class="panel-body" align="center">
                <img src="<?= '/electrop/backend/web/' . $model->picture ?>" width="70%" height="70%" />
        </div>
        <div class="panel-body">
              <?= DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                      [
                          'label' => 'Category',
                          'value' => function ($model) {
                              if ($model->item_category_id == Item::DECALS) {
                                  return 'Decals';
                              } else if ($model->item_category_id == Item::WALL) {
                                  return 'Wall';
                              }
                                  return 'Floor';
                          },
                      ],
                      [
                          'label' => 'Sub Category',
                          'value' => function ($model) {
                              if ($model->item_sub_category_id == Item::JOKES) {
                                  return 'Jokes';
                              } else if ($model->item_sub_category_id == Item::BRANDS) {
                                  return 'Wall';
                              } else if ($model->item_sub_category_id == Item::ANIMALS) {
                                  return 'Animals';
                              }
                                  return 'Random';
                          },
                      ],
                      [
                          'label' => 'Qty. Available',
                          'value' => function ($model) {
                              return $model->quantity_remaining;
                          },
                      ],
                      'size',
                      [
                          'label' => 'Price',
                          'value' => function ($model) {
                              $priceToShow = '$ ' . $model->gross_price;

                              return $priceToShow;
                          },
                      ],
                      'description:ntext'
                  ],
              ]) ?>
        </div>
    </div>
  </div>
  <div class="col-sm-3 col-xs-push-1">
      <div class="panel panel-default">
          <div class="panel-heading text-center">
              <h1>Quantity: <span id="quantity"></span></h1>
          </div>
          <div class="panel-body">
              <div class="col-sm-6">
                <br>
                  <div class="btn-group">
                      <?= Html::a('', '#', ['class' => 'btn btn-danger glyphicon glyphicon-minus redCss', 'id' => 'decrementar']) ?>
                      <?= Html::a('', '#', ['class' => 'btn btn-default glyphicon glyphicon-plus', 'id' => 'incrementar']) ?>
                  </div>
              </div>
              <div class="col-sm-7">
                  <div class="form-group text-left"><h1> <span>$<span id="precioDisplay"><?= $model->gross_price?></span></span></h1></div>
                  <br>
              </div>
              <div style="text-align:center;">
                  <br>
                  <br>
                     <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action'=>Url::toRoute(['item/add-to-cart','id'=>$model->item_id])]); ?>
                                <?=Html::input('submit','submit','Add to cart',[ 'class'=>'btn btn-danger redCss', ])?>
                     <?php ActiveForm::end(); ?>
              </div>
          </div>
      </div>
  </div>
</div> 