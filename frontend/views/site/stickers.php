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
?>

<div class="container">
      <div class="col-sm-3">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Categories
              </div>
              <ul class="list-group">
                    <li class="list-group-item borderless" style="border: none"><label>STICKERS</label></li>
                    <li class="list-group-item borderless" style="border: none">Decals</li>
                    <li class="list-group-item borderless text-center" style="border: none">Jokes</li>
                    <li class="list-group-item borderless text-center" style="border: none">Brands</li>
                    <li class="list-group-item borderless text-center" style="border: none">Animals</li>
                    <li class="list-group-item borderless text-center" style="border: none">Random</li>
              </ul>
              <ul class="list-group">
                    <li class="list-group-item borderless" style="border: none">Wall</li>
                    <li class="list-group-item borderless text-center" style="border: none">Jokes</li>
                    <li class="list-group-item borderless text-center" style="border: none">Brands</li>
                    <li class="list-group-item borderless text-center" style="border: none">Animals</li>
                    <li class="list-group-item borderless text-center" style="border: none">Random</li>
              </ul>
              <ul class="list-group">
                    <li class="list-group-item borderless" style="border: none">Floor</li>
                    <li class="list-group-item borderless text-center" style="border: none">Jokes</li>
                    <li class="list-group-item borderless text-center" style="border: none">Brands</li>
                    <li class="list-group-item borderless text-center" style="border: none">Animals</li>
                    <li class="list-group-item borderless text-center" style="border: none">Random</li>
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
        <div class="panel panel-default">
            <div class="panel-body">
                <h1><label>Stickers</label></h1>
                <br>
                <h5>We have the best stickers in design, quality and variety worldwide!</h5>
            </div>
        </div>
        <?= $this->render('_stickerList', ['stickerList' => $stickerList]); ?>
    </div>
</div>
