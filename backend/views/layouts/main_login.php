<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<link rel="icon"
      type="image/png"
      href="<?= Url::to('@web/images/Admin.png') ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ELECTROP Stickers Store">
    <link rel="copyright" href="<?= Url::to(['site/about']) ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="container" id="mainLog">
  <?php $this->beginBody() ?>
    <div class="container" style="margin:auto">
      <?= $content ?>
    </div>
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>