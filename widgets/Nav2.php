<?php
namespace app\widgets;
use yii\bootstrap\Nav;
use yii\helpers\Html;

class Nav2 extends Nav
{
    public function init()
    {
        parent::init();

        // Удаляем класс NAV, т.к. по шаблону он не нужен
        Html::removeCssClass($this->options, 'nav');
    }
}