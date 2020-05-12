<?php

namespace app\modules\chat;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/chat/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/chat/messages',
            'fileMap' => [
                'modules/chat/module' => 'module.php',
            ],
        ];
    }
}