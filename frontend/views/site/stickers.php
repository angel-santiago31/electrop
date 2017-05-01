<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Stickers';
$this->params['breadcrumbs'][] = $this->title;
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/electrop/backend/web/uploads/icon.png']);
?>

<div class="container">
    <div class="col-sm-6">
        
    </div>
    <div class="col-sm-6">
       <?= $this->render('_searchbar', ['model' => $model]); ?>
    </div>
</div>
    
<div class="container">
      <div class="col-sm-3">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Categories
              </div>
              <ul class="list-group">
                    <li class="list-group-item borderless" style="border: none"><label>STICKERS</label></li>
                    <li class="list-group-item borderless">Decals</li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Jokes', ['site/stickers', 'category' => Item::DECALS, 'subcategory' => Item::JOKES], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Brands', ['site/stickers', 'category' => Item::DECALS, 'subcategory' => Item::BRANDS], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Animals', ['site/stickers', 'category' => Item::DECALS, 'subcategory' => Item::ANIMALS], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Random', ['site/stickers', 'category' => Item::DECALS, 'subcategory' => Item::RANDOM], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
              </ul>
              <ul class="list-group">
                    <li class="list-group-item borderless">Wall</li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Jokes', ['site/stickers', 'category' => Item::WALL, 'subcategory' => Item::JOKES], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Brands', ['site/stickers', 'category' => Item::WALL, 'subcategory' => Item::BRANDS], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Animals', ['site/stickers', 'category' => Item::WALL, 'subcategory' => Item::ANIMALS], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Random', ['site/stickers', 'category' => Item::WALL, 'subcategory' => ITEM::RANDOM], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
              </ul>
              <ul class="list-group">
                    <li class="list-group-item borderless">Floor</li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Jokes', ['site/stickers', 'category' => Item::FLOOR, 'subcategory' => Item::JOKES], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Brands', ['site/stickers', 'category' => Item::FLOOR, 'subcategory' => Item::BRANDS], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Animals', ['site/stickers', 'category' => Item::FLOOR, 'subcategory' => Item::ANIMALS], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
                    <li class="list-group-item borderless text-center" style="border: none" id="hov">
                        <?= Html::a('Random', ['site/stickers', 'category' => Item::FLOOR, 'subcategory' => Item::RANDOM], ['class' => 'btn btn-link', 'id' => 'hov']) ?>
                    </li>
              </ul>
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">
                  Sort By
              </div>
              <div class="panel-body">
                  <?= $this->render('_search', ['model' => $model]); ?>
              </div>
          </div>
      </div>
    
    <div class="col-sm-9">
        <div class="panel panel-default text-center">
            <div class="panel-body">
                <h1><label>Stickers</label></h1>
                <br>
                <h5>We have the best stickers in design, quality and variety worldwide!</h5>
            </div>
        </div>
        <?= $this->render('_stickerList', ['stickerList' => $stickerList]); ?>
    </div>
</div>
