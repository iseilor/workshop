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

    /**
     * КНП - Корпоративная норма площади, м2 в метрах
     * @param $n - Кол-во членов семьи, шт
     * @return float|int - Кол-во площади, м2
     */
    public static function getKNP($n){
        switch ($n) {
            case 1:
                return 35;
                break;
            case 2:
                return 50;
                break;
            default:
                return $n*20;
                break;
        }
    }
}
