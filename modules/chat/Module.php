<?php

namespace app\modules\chat;

use Yii;

/**
 * chat module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\chat\controllers';

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
        return Yii::t('modules/chat/' . $category, $message, $params, $language);
    }
}
