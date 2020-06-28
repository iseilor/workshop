<?php

namespace app\modules\project;

use Yii;
use yii\base\BootstrapInterface;

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
                'modules/project/project' => 'project.php',
                'modules/project/task' => 'task.php',
                'modules/project/report' => 'report.php',
            ],
        ];
    }
}