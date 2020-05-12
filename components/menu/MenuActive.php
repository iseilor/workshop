<?php

namespace app\components\menu;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

class MenuActive extends Menu
{

    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{activeClass}'=> ($item['active']==1)? 'active':'',
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{label}' => $item['label'],
            ]);
        }
    }

}