<?php

namespace app\modules\pulsar;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/pulsar/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/pulsar/messages',
            'fileMap' => [
                'modules/pulsar/module' => 'module.php',
            ],
        ];
    }
}