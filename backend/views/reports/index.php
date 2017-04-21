<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="contains">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="jumbotron text-center">
                <h1><i class="glyphicon glyphicon-file"></i> <?= Html::encode($this->title) ?></h1>
            </div>
        </div>
        <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <p>
                        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Create Report', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            //'id',
                            'title',
                            //'description:ntext',
                            'type',
                            'from_date:date',
                            'to_date:date',
                            // 'refers_to',

                            [
                                'label' => 'View PDF',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if($model->item_selected == NULL)
                                    {
                                        $model->item_selected = 'No Specific Item';
                                        return Html::a('<i class="glyphicon glyphicon-file"></i> PDF', ['pdf', 'id' => $model->id, 'fromDate' => $model->from_date, 'toDate' => $model->to_date, 'groupedBy' => $model->refers_to, 'itemSelected' => $model->item_selected], ['class' => 'btn btn-xs btn-danger', 'target' => '_blank']);
                                    }
                                    else
                                    {
                                        return Html::a('<i class="glyphicon glyphicon-file"></i> PDF', ['pdf', 'id' => $model->id, 'fromDate' => $model->from_date, 'toDate' => $model->to_date, 'groupedBy' => $model->refers_to, 'itemSelected' => $model->item_selected], ['class' => 'btn btn-xs btn-danger', 'target' => '_blank']);
                                    }
                                }
                            ],
                        ],
                    ]); ?>
                    </div>
        </div>
    </div>
</div>
