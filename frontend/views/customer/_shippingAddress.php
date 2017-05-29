<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\registraduria\models\TranscripcionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelActive backend\modules\registraduria\models\TranscripcionSearch */
/* @var $dataProviderActive yii\data\ActiveDataProvider */

?>
<?php Pjax::begin(); ?>

    <?= Html::button('<i class="glyphicon glyphicon-plus"></i> Add new Address',
                    ['value' => Url::to(['add-address', 'id' => $id]),
                     'class' => 'btn btn-default pull-right', 'id' => 'addAddress']); ?>
    <br>
    <br>
   <?= GridView::widget([
    'dataProvider' => $address,
    'columns' => [
        'street_name',
        'apt_number',
        'zipcode',
        'state',
        [
            'label' => 'More',
            'format' => 'html',
            'value' => function ($address) {
                return Html::a('<i class="glyphicon glyphicon-edit"></i> Update', ['update-address', 'id' => $address->customer_id, 'street' => $address->street_name], ['class' => 'btn btn-xs btn-danger redCss', 'id' => 'updateAdress']);
            }
        ],
        [
            'label' => '',
            'format' => 'html',
            'value' => function ($address) {
                return Html::a('<i class="glyphicon glyphicon-remove"></i> Remove', ['delete-address', 'id' => $address->customer_id, 'street' => $address->street_name], ['class' => 'btn btn-xs btn-danger redCss', 'id' => 'updateAdress']);
            }
        ],
    ],
]) ?>

   
<?php Pjax::end(); ?>
