<?php
namespace app\modules\jk\assets;
use yii\web\AssetBundle;

class JkAdminAsset extends AssetBundle
{
    public $sourcePath = '@app';
    public $css = [];
    public $js = [
        "vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.bundle.min.js",
        "modules/jk/web/js/jk-admin.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}