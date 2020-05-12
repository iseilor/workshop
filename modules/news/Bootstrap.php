<?php

namespace app\modules\news;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/news/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/news/messages',
            'fileMap' => [
                'modules/news/module' => 'module.php',
            ],
        ];
    }
}