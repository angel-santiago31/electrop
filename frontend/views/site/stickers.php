<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use backend\controllers\ItemController;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Stickers';
?>

<h1> Stickers </h1>

<?php 
    $stickersController = Item::find()->limit(6)->all();
    foreach($stickersController as $sticker){
?>
  <div class="container" style="background-color: lightgray;">
        <div class="row">
            <div class="col-sm-12">
                            <div class="row">
                                        <div class="col-sm-4" style="text-align: center;">
                                            <img src='<?= Url::to($sticker->picture); ?>' height="150" width="150" />
                                            <div class="row">
                                                <div class="col-sm-12" style="text-align: center;">
                                                    <?php echo $sticker->name  ?>
                                                    <br>
                                                    <?php echo '$' . $sticker->gross_price ?>
                                                    <br>
                                                    <?= Html::a('label', ['/site/stickers'], ['class'=>'btn btn-primary']) ?>
                                                </div>
                                            </div>
                                        </div>
                                         <?php  } ?>
                            </div>
            </div>
        </div>            
</div>




