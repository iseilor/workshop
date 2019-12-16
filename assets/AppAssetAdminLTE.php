<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAssetAdminLTE extends AssetBundle
{

    //public $basePath = '@webroot';

    //public $baseUrl = '@web';

    public $sourcePath = '@adminlte';

    public $css
        = [
            'plugins/fontawesome-free/css/all.css',
            'dist/css/adminlte.css',
        ];

    public $js
        = [
            //'plugins/jquery/jquery.js',
            'plugins/bootstrap/js/bootstrap.bundle.js',
            'dist/js/adminlte.js',
            'dist/js/demo.js',
        ];
    public $depends
        = [
            'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
        ];
}