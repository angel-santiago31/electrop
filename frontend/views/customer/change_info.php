<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;   
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = $this->title;

?>
<div id="modalContent" align="center"> 
                <div class="row">
            <div class="col-sm-12">
                <?php $form = ActiveForm::begin(['id' => 'customer-account-form']); ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'email')->textInput() ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'firstName')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'middleName')->label('Middle Name (Optional)') ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'fathersLastName')->textInput() ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'mothersLastName')->textInput()?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'dateOfBirth')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?=
                            Html::submitButton('<i class="glyphicon glyphicon-pencil"></i> Change', ['class' => 'btn btn-danger redCss', 'name' => 'update-customer-info-button']);
                        ?>
                    </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>