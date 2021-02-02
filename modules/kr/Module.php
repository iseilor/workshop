<?php

namespace app\modules\kr;

use app\modules\kr\assets\KRAsset;
use Yii;

/**
 * kr module definition class
 */
class Module extends \yii\base\Module
{

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\kr\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        //KRAsset::register(Yii::$app->view);
        parent::init();
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/kr/' . $category, $message, $params, $language);
    }

    // Иконка
    public static function getIcon()
    {
        return 'crown';
    }
}