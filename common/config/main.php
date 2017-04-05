<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'dd/MM/yyyy',
            'locale' => 'en-US',
            'timeZone' => 'America/Puerto_Rico',
            //'decimalSeparator' => ',',
            //'thousandSeparator' => ' ',
            //'currencyCode' => 'EUR',
        ],
    ],
];
