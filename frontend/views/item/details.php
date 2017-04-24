<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use backend\models\Item;
use backend\models\StickerSize;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = 'Product Details';
?>
<div class="container">
  <div class="col-sm-5 col-xs-push-2">
    <div class="panel panel-default">
        <div class="panel-body" align="center">
                <img src="<?= '/electrop/backend/web/' . $model->picture ?>" class="stickerImg"/>
        </div>
        <div class="panel-footer">
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
                              return ($model->quantity_remaining == NULL) ? 'Out of stock' : $model->quantity_remaining;
                          },
                      ],
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
  <div class="col-sm-3 col-xs-push-2">
      <div class="panel panel-default">
          <div class="panel-heading text-center">
              <h1>Quantity: <span id="qtyD"><?= $model->quantity ?></span></h1>
          </div>
          <div class="panel-body text-center">
              <div class="col-sm-6">
                  <br>
                  <div class="btn-group">
                      <?= Html::button('<i class="glyphicon glyphicon-minus"></i>', ['class' => 'btn btn-default', 'id' => 'decrementar']) ?>
                      <?= Html::button('<i class="glyphicon glyphicon-plus"></i>', ['class' => 'btn btn-danger redCss', 'id' => 'incrementar']) ?>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div><h1><span>$<span id="precioDisplay"><?= $model->gross_price?></span></span></h1></div>
              </div>
          </div>
      </div>
      <div hidden="true"> <span id="qtyRemaining"><?= $model->quantity_remaining; ?></span></div>
      <div class="panel panel-default text-center">
          <div class="panel-body">
              <div class="btn-group">
                  <?php $form = ActiveForm::begin(); ?>
                      <?= $form->field($model, 'quantity')->hiddenInput()->label(false) ?>
                      <?= $form->field($model, 'gross_price')->hiddenInput()->label(false) ?>
                      <?= Html::a('View More', ['site/stickers'], ['class' => 'btn btn-default']) ?>
                      <?= Html::submitButton('<i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart', ['class' => 'btn btn-danger redCss', 'disabled' => $model->quantityNotEmpty]) ?>
                  <?php ActiveForm::end(); ?>
              </div>
          </div>
      </div>
  </div>
</div>
