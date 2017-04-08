<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;   
use yii\widgets\DetailView;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    'web/js/render.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<h1><?php echo 'Welcome ' . Yii::$app->user->identity->first_name . '!'; ?> </h1>
<div class="col-sm-12">
    <div class="col-sm-6">
        <div class="panel" >
            <div class="panel-heading">
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
    </div>
    <div class="col-sm-6">
        <div class="panel-body" align="center"> 
            <?= DetailView::widget([
                  'model' => Yii::$app->user->identity,
                  'attributes' => [
                      'first_name',
                      'fathers_last_name',
                      'mothers_last_name',
                      'email',
                      'date_of_birth'
                ]
              ])
            ?>
            <?=
                Html::submitButton('<i class="glyphicon glyphicon-pencil"></i> Change', ['class' => 'btn btn-danger redCss', 'name' => 'signup-button']);
            ?>
        </div>
    </div>
</div>