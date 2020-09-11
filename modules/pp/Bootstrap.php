<?php

namespace app\modules\pp;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/pp/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/pp/messages',
            'fileMap' => [
                'modules/pp/module' => 'module.php'
            ],
        ];
    }
}