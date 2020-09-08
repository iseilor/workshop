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
                'modules/jk/calculator' => 'calculator.php',
                'modules/jk/percent'=>'percent.php',
                'modules/jk/zaim'=>'zaim.php',
                'modules/jk/zaim_type' => 'zaim_type.php',
                'modules/jk/order'=>'order.php',
                'modules/jk/stop'=>'stop.php',
                'modules/jk/order_stop'=>'order_stop.php',
                'modules/jk/order_stage'=>'order_stage.php',
                'modules/jk/social'=>'social.php',
                'modules/jk/agreement'=>'agreement.php',
                'modules/jk/message'=>'message.php',
                'modules/jk/rf'=>'rf.php',
                'modules/jk/faq' => 'faq.php',
                'modules/jk/doc' => 'doc.php',
                'modules/jk/status' => 'status.php',
            ],
        ];
    }
}