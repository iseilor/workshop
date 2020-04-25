<?php

namespace app\modules\project;

use yii\base\BootstrapInterface;
use Yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/project/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/project/messages',
            'fileMap' => [
                'modules/project/module' => 'module.php',
                'modules/project/project' => 'project.php'
            ],
        ];
    }
}