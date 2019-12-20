<?php

namespace app\modules\jk\assets;

use yii\web\AssetBundle;

class ZaimAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/jk/web';
    public $js
        = [
            'js/jk_zaim.js',
        ];
    public $depends
        = [
            'yii\web\YiiAsset',
        ];
}