<?php

namespace app\modules\jk\assets;

use yii\web\AssetBundle;

class CuratorAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/jk/web';
    public $baseUrl = '/jk';

    public $js
        = [
            'js/jk_percent.js',
        ];
    public $css= [
        'css/jk.css',
    ];
    public $depends
        = [
            'yii\web\YiiAsset',
        ];
}