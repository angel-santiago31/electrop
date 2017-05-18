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
    <?php 
        echo '<pre>';
        var_dump($cards);
        die(4);
    //     if(!empty($payment_method))
    // {
    //     foreach ($payment_method as $payment)
    //     {
    //         echo 'Card Last Digits: '.$payment['card_last_digits'].'</br>';
    //         echo 'Expiration Date: '.$payment['exp_date'].'</br>';
    //         echo 'Card Type: '.$payment['card_type'].'</br>';
    //         echo '</br>';
    //     }
        
    // }
     ?>
     <?= Html::button('<i class="glyphicon glyphicon-plus"></i> Add a Card',
                    ['value' => Url::to(['add-payment']),
                     'class' => 'btn btn-default pull-right', 'id' => 'addPayment']); ?>
    <br>
    <br>
   <?= GridView::widget([
    'dataProvider' => $cards,
    'columns' => [
        'card_last_digits',
        'exp_date',
        'card_type',
        [
            'label' => 'More',
            'format' => 'html',
            'value' => function ($cards) {
                return Html::a('<i class="glyphicon glyphicon-pencil"></i> Update', ['update-payment', 'id' => $cards->customer_id], ['class' => 'btn btn-xs btn-danger redCss', 'id' => 'updatePayment']);
            }
        ],
    ],
]) ?>
<!--<?= Html::button('<i class="glyphicon glyphicon-pencil"></i> Update',
                    ['value' => Url::to(['update-payment', 'id' => $id]),
                     'class' => 'btn btn-danger pull-right redCss', 'id' => 'updatePayment']); ?>-->
 
<?php Pjax::end(); ?>
