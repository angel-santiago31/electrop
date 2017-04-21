<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventory';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-12">
    <div class"container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="jumbotron">
                    <h1><?= '<span class="glyphicon glyphicon-inbox"></span> ' . Html::encode($this->title)?></h1>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-9">
                        <?= $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                    <div class="col-sm-3">
                        <p>
                            <br>
                            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Create Item', ['create'], ['class' => 'btn btn-success pull-right']) ?>
                        </p>
                    </div>
                </div>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'name',
                        [
                            'attribute' => 'Active',
                            'value' => function ($model) {
                                    return ($model->active === Item::ACTIVE)?
                                        'Active' : 'Inactive';
                            },
                        ],
                        //'picture',
                        'quantity_remaining',
                        //'size',
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
                        // 'description:ntext',

                        //['class' => 'yii\grid\ActionColumn'],
                        [
                            'label' => 'More',
                            'format' => 'html',
                            'value' => function ($model) {
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i> View Details', ['view', 'id' => $model->item_id], ['class' => 'btn btn-xs btn-info']);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>    
</div>
