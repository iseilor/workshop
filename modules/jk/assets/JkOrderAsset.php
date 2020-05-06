<?php
namespace app\modules\jk\assets;
use yii\web\AssetBundle;

class JkOrderAsset extends AssetBundle
{
    public $sourcePath = '@app';
    public $css = [];
    public $js = [
        "modules/jk/web/js/jk-order-intro.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}