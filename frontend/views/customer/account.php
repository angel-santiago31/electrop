<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\sidenav\SideNav;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;   
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    'web/js/render.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<h1><?php echo 'Welcome ' . Yii::$app->user->identity->first_name . '!'; ?> </h1>
<div class="container">
    <div class="col-sm-12">
        <div class="col-sm-4">
                <div class="panel-default">
                    <?php 
                        echo SideNav::widget([
                                    'type' => SideNav::TYPE_DEFAULT,
                                    //'heading' => 'Options',
                                    'items' => [
                                        [
                                            'url' => ['/site/contact'],
                                            'label' => 'My Account',
                                            'icon' => 'user'
                                        ],
                                        [
                                            'url' => ['/site/contact'],
                                            'label' => 'My Orders',
                                            'icon' => 'list-alt'
                                        ]
                                        ],
                                    ]);
                    ?>
                </div>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-heading">
                    <h2>Account Information</h2>
                </div>
            <div class="panel-body" align="center"> 
                <div class="row">
                    <div class="col-sm-12">
                            <div class="col-sm-9">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'email',
                                        'first_name',
                                        'middle_name',
                                        'fathers_last_name'
                                    ],
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?=
                                    Html::submitButton('<i class="glyphicon glyphicon-pencil"></i> Change', [ 'value' => Url::to(['/customer/form']), 'class' => 'btn btn-danger redCss', 'id' => 'updateInfo', 'name' => 'update-customer-info-button']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>