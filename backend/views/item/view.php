<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Item;
use backend\models\StickerSize;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="col-sm-10">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h1><?= '<span class="glyphicon glyphicon-inbox"></span> ' . Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
              <p>
                  <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update', 'id' => $model->item_id], ['class' => 'btn btn-warning']) ?>
                  <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Restore', ['restore', 'id' => $model->item_id], ['class' => $model->isActive]) ?>
                  <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Delete', ['delete', 'id' => $model->item_id], [
                      'class' => $model->IsInactive,
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) ?>
              </p>

              <?= DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                      'item_id',
                      [
                         'attribute' => 'Active',
                         'value' => function ($model) {
                                 return ($model->active === Item::ACTIVE)?
                                    'Active' : 'Inactive';
                          },
                    ],
                      'name',
                      //'picture',
                      'quantity_remaining',
                      [
                          'attribute' => 'size',
                          'value' => function ($model) {
                              if ($model->size == StickerSize::SMALL) {
                                  return 'Small (2.7" x 4.0")';
                              } else if ($model->size == StickerSize::MEDIUM) {
                                  return 'Medium (3.7" x 5.5")';
                              } else if ($model->size == StickerSize::LARGE) {
                                  return 'Large (5.7" x 8.5")';
                              }

                              return 'Extra Large (9.4" x 14.0")';
                          },
                      ],
                      [
                          'attribute' => 'Gross Price',
                          'value' => function ($model) {
                              $priceToShow = '$ ' . $model->gross_price;

                              return $priceToShow;
                          },
                      ],
                      [
                          'attribute' => 'Gross Price',
                          'value' => function ($model) {
                              $priceToShow = '$ ' . $model->production_cost;

                              return $priceToShow;
                          },
                      ],
                      //'gross_price',
                      //'production_cost',
                      'description:ntext',
                      [
                          'attribute'=>'file',
                          'label' => 'Picture',
                          'value'=> \Yii::$app->request->BaseUrl.'/'.$model->picture,
                          'format' => ['image',['width'=>'100','height'=>'100']],
                      ],
                  ],
              ]) ?>
        </div>
    </div>
  </div>
</div>
