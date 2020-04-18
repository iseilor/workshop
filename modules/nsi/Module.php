<?php

namespace app\modules\nsi;

use Yii;

/**
 * nsi module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\nsi\controllers';

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
        return Yii::t('modules/nsi/' . $category, $message, $params, $language);
    }
}
