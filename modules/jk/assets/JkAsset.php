<?php

namespace app\modules\jk\assets;

use yii\web\AssetBundle;

class JkAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/jk/web';
    public $js
        = [
            'js/jk.js',
        ];
    public $depends
        = [
            'yii\web\YiiAsset',
        ];
}