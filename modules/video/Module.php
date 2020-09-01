<?php

namespace app\modules\video;

use Yii;

/**
 * video module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\video\controllers';

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
        return Yii::t('modules/video/' . $category, $message, $params, $language);
    }
}
