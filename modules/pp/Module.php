<?php

namespace app\modules\pp;

use Yii;

/**
 * pp module definition class
 */
class Module extends \yii\base\Module
{

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\pp\controllers';

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
        return Yii::t('modules/pp/' . $category, $message, $params, $language);
    }

    // Иконка
    public static function getIcon(){
        return 'coins';
    }
}
