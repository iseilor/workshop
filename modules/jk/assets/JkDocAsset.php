<?php
namespace app\modules\jk\assets;
use yii\web\AssetBundle;

class JkDocAsset extends AssetBundle
{
    public $sourcePath = '@app';
    public $css = [];
    public $js = [
        "modules/jk/web/js/jk-doc.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}