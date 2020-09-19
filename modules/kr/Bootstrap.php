<?php

namespace app\modules\kr;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/kr/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/kr/messages',
            'fileMap' => [
                'modules/kr/module' => 'module.php',
                'modules/kr/curator'=>'curator.php',
                'modules/kr/student'=>'student.php'
            ],
        ];
    }
}