<?php
namespace app\modules\jk\assets;
use yii\web\AssetBundle;

class JkFaqAsset extends AssetBundle
{
    public $sourcePath = '@app';
    public $css = [];
    public $js = [
        "modules/jk/web/js/jk-faq.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}