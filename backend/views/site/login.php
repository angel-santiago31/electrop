<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;


$this->title = 'ELECTROP';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-9" style="padding-left: 25%">
  <div class="login-space hidden-xs hidden-md">
    <br><br>
  </div>
  <h1 class="login-title text-center">
    <img height="auto" width="82" alt="Logo UPRA" class="" src="<?= Url::to('@web/images/admin.png') ?>"></img>
      <?= Html::encode($this->title) ?>: PERSONAL
  </h1>
  <div class="panel panel-default login-body-card">
    <div class="panel-body">
            <small>Please fill out the following fields to login:</small>
              <?php $form = ActiveForm::begin(['options' => ['id' => 'login-form']]); ?>
                    <?= $form->field($model, 'email')->textInput(['placeholder'=>'Enter email...']); ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Enter password...']); ?>

                <div class="form-group" style="padding-bottom:5%;">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-success login-btn col-sm-12 col-xs-12', 'name' => 'login-button']) ?>
                </div>
                <p class="text-muted text">By Login in you are agreeing with Electrop Policies about Fair Use of Electronic Resources.
                </p>
            <?php ActiveForm::end(); ?>
          <br>
        <p class="pull-left">&copy; ELECTROP <?= date('Y') ?></p>
    </div>
  </div>
</div>
