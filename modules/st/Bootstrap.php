<?php

namespace app\modules\st;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/st/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/st/messages',
            'fileMap' => [
                'modules/st/module' => 'module.php'
            ],
        ];
    }
}