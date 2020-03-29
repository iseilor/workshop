<?php


namespace app\modules\pulsar\assets;

use yii\web\AssetBundle;

class PulsarAsset extends AssetBundle
{

    public $sourcePath = '@adminlte';

    public $css
        = [

        ];

    public $js
        = [
            'plugins/chart.js/Chart.min.js',
        ];
    public $depends
        = [
            'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
        ];
}