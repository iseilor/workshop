<?php

namespace app\modules\admin;

use Yii;
use yii\base\BootstrapInterface;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/admin/' . $category, $message, $params, $language);
    }

    public function bootstrap($app)
    {
        $app->i18n->translations['modules/admin/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'ru-RU',
            'forceTranslation' => true,
            'basePath' => '@app/modules/admin/messages',
            'fileMap' => [
                'modules/admin/module' => 'module.php',
            ],
        ];
    }
}
