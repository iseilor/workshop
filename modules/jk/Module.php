<?php

namespace app\modules\jk;

use app\modules\jk\models\CorpNorm;
use app\modules\user\models\User;
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
        $items = CorpNorm::find()->orderBy('number asc')->all();

        if ($n < 3) {
            foreach ($items as $item) {
                if ($n == $item->number) {
                    return $item->area;
                }
                return 0;
            }
        } else {
            return $n*20;
        }

        /*switch ($n) {
            case 1:
                return 35;
                break;
            case 2:
                return 50;
                break;
            default:
                return $n*20;
                break;
        }*/
    }

    // Ставка компенсации процентов SKP
    public static function getSKP($moneyMonth){
        $SKP = 12;
        $user = User::findOne(Yii::$app->user->identity->getId());

        // До 35 лет и после 35
        if ($user->getYears() <= 35) {
            if ($moneyMonth > 35000) {
                $SKP = 6;
            } elseif ($moneyMonth > 25000) {
                $SKP = 8;
            } elseif ($moneyMonth > 15000) {
                $SKP = 10;
            } else {
                $SKP = 12;
            }
        } else {
            if ($moneyMonth > 35000) {
                $SKP = 4;
            } elseif ($moneyMonth > 25000) {
                $SKP = 6;
            } elseif ($moneyMonth > 15000) {
                $SKP = 8;
            } else {
                $SKP = 10;
            }
        }
        return $SKP;
    }

}
