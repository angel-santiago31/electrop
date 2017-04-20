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
        'model' => $phone,
        'attributes' => [
            'number',
        ],
    ]) ?>

    <?= Html::button('<i class="glyphicon glyphicon-pencil"></i> Update',
                    ['value' => Url::to(['update-phone', 'id' => $id]),
                     'class' => 'btn btn-danger pull-right redCss', 'id' => 'updatePhoneNumber']); ?>
<?php Pjax::end(); ?>
