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
        'model' => $model,
        'attributes' => [
            'email:email',
            'first_name',
            'middle_name',
            'fathers_last_name',
            'mothers_last_name',
            'date_of_birth',
        ],
    ]) ?>

    <?= Html::button('<i class="glyphicon glyphicon-pencil"></i> Update',
                    ['value' => Url::to(['update', 'id' => $model->id]),
                     'class' => 'btn btn-danger pull-right redCss', 'id' => 'updateInfo']); ?>
<?php Pjax::end(); ?>
