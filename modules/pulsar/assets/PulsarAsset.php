<?php
namespace app\modules\pulsar\assets;
use yii\web\AssetBundle;

class PulsarAsset extends AssetBundle
{
    public $sourcePath = '@app';
    public $css = [];
    public $js = [
            "vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.bundle.min.js",
            "modules/pulsar/web/js/pulsar.js"
    ];
    public $depends = [
            'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
    ];
}