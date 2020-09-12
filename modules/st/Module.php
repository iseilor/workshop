<?php

namespace app\modules\st;

use Yii;

/**
 * st module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\st\controllers';

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
        return Yii::t('modules/st/' . $category, $message, $params, $language);
    }

    public static function getIcon(){
        return 'star';
    }
}
