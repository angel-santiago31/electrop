<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\controllers\CustomerController;
use yii\bootstrap\Modal;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php
       Modal::begin([
           'header' => '<h1><i class="glyphicon glyphicon-pencil"></i> Update Account Details</h1>',
           'id' => 'modal',
           'size' => 'modal-lg',
           'clientOptions' => ['keyboard' => FALSE, 'backdrop' => 'static']
       ]);

       echo "<div id = 'modalContent'>
       </div>";

       Modal::end();
   ?>
<body>
<?php $this->beginBody() ?>

<div class="wrap" style="background-color: #f0f0f5">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('/electrop/backend/web/uploads/logo.png', ['alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        //['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Stickers', 'url' => ['/site/stickers']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Register', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => '<i class="glyphicon glyphicon-user"></i>',
            'items' => [
                ['label' => '<li>'
                . Html::beginForm(['/customer/account', 'id' => Yii::$app->user->identity->id])
                . Html::submitButton(
                    '<i class="glyphicon glyphicon-user"></i> My Account',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>' . '<li class="divider">|</li>'
                ],
                ['label' =>
                    '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="glyphicon glyphicon-log-out"></i> Logout (' . Yii::$app->user->identity->first_name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>']
            ]
        ];
    }
    $menuItems[] = ['label' => '<i class="glyphicon glyphicon-shopping-cart"></i>', 'url' => ['/item/cart-view']];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer" style="background: #4c4c4c;"background: orange;>
    <div class="container">
        <p style="text-align:center; color:white;">&copy; Electrop  <?= date('Y') ?> at Puerto Rico</p>

        <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
