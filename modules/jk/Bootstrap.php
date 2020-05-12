<?php

namespace app\modules\jk;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/jk/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/jk/messages',
            'fileMap' => [
                'modules/jk/module' => 'module.php',
                'modules/jk/zaim_type' => 'zaim_type.php',
                'modules/jk/order'=>'order.php',
                'modules/jk/stop'=>'stop.php',
                'modules/jk/order_stop'=>'order_stop.php',
                'modules/jk/social'=>'social.php',
                'modules/jk/agreement'=>'agreement.php',
                'modules/jk/messages'=>'messages.php',
            ],
        ];
    }
}