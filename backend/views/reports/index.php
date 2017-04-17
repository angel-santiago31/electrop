<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reports-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reports', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'description:ntext',
            'type',
            'from_date',
            'to_date',
            // 'refers_to',

            [
                'label' => 'View PDF',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('<i class="glyphicon glyphicon-file"></i> PDF', ['pdf', 'id' => $model->id, 'fromDate' => $model->from_date, 'toDate' => $model->to_date, 'groupedBy' => $model->refers_to], ['class' => 'btn btn-xs btn-danger', 'target' => '_blank']);
                }
            ],
        ],
    ]); ?>
</div>
