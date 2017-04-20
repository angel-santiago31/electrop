<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\registraduria\models\TranscripcionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelActive backend\modules\registraduria\models\TranscripcionSearch */
/* @var $dataProviderActive yii\data\ActiveDataProvider */

?>
<?php Pjax::begin(); ?>
    <?= DetailView::widget([
        'model' => $payment_method,
        'attributes' => [
            'card_last_digits',
            'exp_date',
            'card_type',
        ],
    ]) ?>

    <?= Html::button('<i class="glyphicon glyphicon-pencil"></i> Update',
                    ['value' => Url::to(['update']),
                     'class' => 'btn btn-danger pull-right redCss', 'id' => 'updatePaymentMethod']); ?>
<?php Pjax::end(); ?>
