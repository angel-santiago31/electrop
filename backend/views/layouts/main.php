<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;
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
           'header' => '<h1><i class="glyphicon glyphicon-pencil"></i> Update Status</h1>',
           'id' => 'modalS',
           'size' => 'modal-lg',
           'clientOptions' => ['keyboard' => FALSE, 'backdrop' => 'static']
       ]);

       echo "<div id = 'modalContent'></div>";

       Modal::end();
   ?>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Electrop',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->email . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <div class="col-sm-2">
            <?php if (!Yii::$app->user->isGuest) {
                echo SideNav::widget([
                        'type' => SideNav::TYPE_DEFAULT,
                        //'heading' => 'Options',
                        'items' => [
                            [
                                'url' => ['#'],
                                'label' => 'Users',
                                'icon' => 'user',
                                'items' => [
                                    ['label' => 'View All', 'url'=> Url::to(['customer/index'])],
                                    ['label' => 'Add New', 'url'=> Url::to(['customer/create'])],
                                ],
                            ],
                            [
                                'url' => ['#'],
                                'label' => 'Admins',
                                'icon' => 'user',
                                'items' => [
                                    ['label' => 'View All', 'url'=> Url::to(['admin/index'])],
                                    ['label' => 'Add New', 'url'=> Url::to(['admin/create'])],
                                ],
                            ],
                            [
                                'url' => ['product/index'],
                                'label' => 'Inventory',
                                'icon' => 'inbox',
                                'items' => [
                                    ['label' => 'View All', 'url'=> Url::to(['item/index'])],
                                    ['label' => 'Add New', 'url'=> Url::to(['item/create'])],
                                ],
                            ],
                            [
                                'url' => ['order/index'],
                                'label' => 'Order History',
                                'icon' => 'list-alt',
                            ],
                            [
                                'label' => 'Reports',
                                'icon' => 'file',
                                'items' => [
                                    ['label' => 'View All', 'url'=> Url::to(['report/index'])],
                                    ['label' => 'Create Report', 'url'=> Url::to(['report/create'])],
                                ],
                            ],
                            ],
                        ]);
            }         ?>
        </div>
        <div class="col-sm-10" id="contentDiv">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
