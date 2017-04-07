<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = 'Product Details';
//$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    'web/js/quantity_selection.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="container">
  <div class="col-sm-6 col-xs-push-1">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h1><?= '<span class="glyphicon glyphicon-list"></span> ' . Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
              <?= DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                      'name',
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
                      'description:ntext',
                      [
                          'attribute'=>'file',
                          'label' => 'Picture',
                          'value'=> '/electrop/backend/web/'.$model->picture,
                          'format' => ['image',['width'=>'100','height'=>'100']],
                      ],
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
              <div class="col-sm-6">
                  <div class="form-group text-left"><h1> <span>$ <span id="precioDisplay">1</span></span></h1></div>
              </div>
          </div>
      </div>
  </div>
</div>
