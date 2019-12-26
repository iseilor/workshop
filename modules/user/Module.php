<?php

namespace app\modules\user;

use Yii;
use yii\base\BootstrapInterface;

/**
 * user module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{

    public $controllerNamespace = 'app\modules\user\controllers';
    public $passwordResetTokenExpire = 3600;

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/user/' . $category, $message, $params, $language);
    }

    public function bootstrap($app)
    {
        $app->i18n->translations['modules/user/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'ru-RU',
            'forceTranslation' => true,
            'basePath' => '@app/modules/user/messages',
            'fileMap' => [
                'modules/user/module' => 'module.php',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
