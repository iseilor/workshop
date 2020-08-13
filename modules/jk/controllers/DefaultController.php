<?php

namespace app\modules\jk\controllers;

use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `jk` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        // Основные блоки
        $items = [
            [
                'col' => 3,
                'color' => 'bg-primary',
                'title' => 'Калькулятор',
                'description' => 'Калькулятор % или займа',
                'icon' => Icon::show('calculator'),
                'url' => Url::to(['/jk/default/calc']),
            ],
            [
                'col' => 3,
                'color' => 'bg-primary',
                'title' => 'Заявка',
                'description' => 'Подать заявку',
                'icon' => Icon::show('file'),
                'url' => Url::to(['/jk/order/create']),
            ],
            [
                'col' => 3,
                'color' => 'bg-primary',
                'title' => 'Документы',
                'description' => 'Нормативная документация',
                'icon' => Icon::show('file'),
                'url' => Url::to(['/jk/doc/index']),
            ],
            [
                'col' => 3,
                'color' => 'bg-primary',
                'title' => 'Вопросы',
                'description' => 'Ответы на вопросы',
                'icon' => Icon::show('question'),
                'url' => Url::to(['/jk/faq/index']),
            ],
        ];
        return $this->render('index', ['items' => $items]);
    }

    public function actionCurator()
    {
        return $this->render('curator');
    }

    // Предварительный экран, при выборе калькулятора
    public function actionCalc()
    {
        return $this->render('calc');
    }

    // Админка в модуле ЖК
    public function actionAdmin()
    {
        return $this->render('admin');
    }
}