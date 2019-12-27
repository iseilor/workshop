<?php

namespace app\modules\jk;

use Yii;

/**
 * jk module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\jk\controllers';

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
        return Yii::t('modules/jk/' . $category, $message, $params, $language);
    }

}
