<?php

namespace app\modules\kr\assets;

use yii\web\AssetBundle;

class KRAsset extends AssetBundle
{

    public $sourcePath = '@app/modules/kr/web';

    public $baseUrl = '/kr';

    public $css = ['css/kr.css'];

    public $depends = ['yii\web\YiiAsset'];
}