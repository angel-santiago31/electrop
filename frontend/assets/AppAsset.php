<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/animate.css'
    ];
    public $js = [
        'js/script.js',
        'js/quantity_selection.js',
        'js/modal.js',
        'js/modalPhone.js',
        'js/modalPayment.js',
        'js/modalNewPayment.js',
        'js/modalAddress.js',
        'js/modalNewAddress.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
