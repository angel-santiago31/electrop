<?php

use yii\helpers\Html;
use yii\helpers\CHtml;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\registraduria\models\TranscripcionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelActive backend\modules\registraduria\models\TranscripcionSearch */
/* @var $dataProviderActive yii\data\ActiveDataProvider */

?>
<?php Pjax::begin(); ?>
    <!--<?php 
        // echo '<pre>';
        // var_dump($cards);
        // die(4);
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
     ?>-->
    <br>
   <?= GridView::widget([
    'dataProvider' => $cards,
    'id' => 'grid',
    'columns' => [
        'card_last_digits',
        'exp_date',
        'card_type',
        [
            'header' => 'Select',
            'class' => 'yii\grid\RadioButtonColumn',
            'radioOptions' => function($model, $key, $index, $column) {
                return ['value' => $model->card_last_digits];
            }
        ]
        // [
        //     'value' => "CHtml::activeRadioButtonList($model,'Lease_Action_id',array('1'=>'OK','2'=>'Late','3'=>'Very Late'),array(
        //     'labelOptions'=>array('style'=>'display:inline'), // add this code
        //     'separator'=>'',
        //     ))",
        // ]
    ],
]) 

?>
 
<?php Pjax::end(); ?>
