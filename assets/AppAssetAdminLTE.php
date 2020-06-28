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
            'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
            'plugins/ekko-lightbox/ekko-lightbox.css',
            'plugins/toastr/toastr.css',
            'plugins/fontawesome-free/css/all.css',

            'plugins/select2/css/select2.min.css',
            'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',

            'dist/css/adminlte.css',

        ];

    public $js
        = [
            //'plugins/jquery/jquery.js',
            //'plugins/jquery-ui/jquery-ui.js',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'plugins/ekko-lightbox/ekko-lightbox.min.js',
            'plugins/toastr/toastr.min.js',

            //'plugins/inputmask/jquery.inputmask.bundle.js',
            'plugins/inputmask/jquery.inputmask.bundle.js',

            'plugins/bootstrap/js/bootstrap.bundle.js',
            'plugins/bs-custom-file-input/bs-custom-file-input.min.js',
            'plugins/bootstrap-switch/js/bootstrap-switch.min.js',

            'plugins/select2/js/select2.full.min.js',


            'dist/js/adminlte.js',
            //'dist/js/demo.js',
        ];
    public $depends
        = [
            'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
        ];
}