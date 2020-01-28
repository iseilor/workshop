<?php

namespace app\modules\chat\assets;

use yii\web\AssetBundle;

class ChatAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/chat/web';
    public $baseUrl = '/chat';

    public $js
        = [
            'js/chat.js',
        ];
    public $depends
        = [
            'yii\web\YiiAsset',
        ];
}