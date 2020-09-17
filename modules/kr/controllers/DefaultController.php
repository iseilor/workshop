<?php

namespace app\modules\kr\controllers;

use kartik\icons\Icon;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `kr` module
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
        // Картинки
        $imgs = [
            [
                'id' => 1,
                'src' => 'kr-1.jpg',
                'title' => 'Программа и условия участия',
                'icon'=>  Icon::show('info'),
                'url'=>Url::to('kr/about')
            ],
            [
                'id' => 2,
                'src' => 'kr-2.jpg',
                'title' => 'Расписание программы',
                'icon'=>  Icon::show('list'),
                'url'=>Url::to('kr/timetable/index')
            ],
            [
                'id' => 3,
                'src' => 'kr-3.jpg',
                'title' => 'Кураторы и тренеры проекта',
                'icon'=>  Icon::show('user-graduate'),
                'url'=>Url::to('kr/curator')
            ],
            [
                'id' => 4,
                'src' => 'kr-4.jpg',
                'title' => 'Участники программы',
                'icon'=>  Icon::show('tasks'),
                'url'=>Url::to('kr/terms')
            ],
        ];

        // Блоки
        $items = [
            /*[
                'col' => 3,
                'bg' => 'primary',
                'title' => 'О программе',
                'description' => 'Условия программы',
                'icon' => Icon::show('info'),
                'url' => Url::to('kr/about'),
            ],
            [
                'col' => 3,
                'bg' => 'primary',
                'title' => 'Расписание',
                'description' => 'Основные этапы и расписание',
                'icon' => Icon::show('list'),
                'url' => Url::to('kr/timetable'),
            ],
            [
                'col' => 3,
                'bg' => 'primary',
                'title' => 'Кураторы',
                'description' => 'Тренеры и кураторы',
                'icon' => Icon::show('user-graduate'),
                'url' => Url::to('kr/curator'),
            ],
            [
                'col' => 3,
                'bg' => 'primary',
                'title' => 'Участники',
                'description' => 'Участники программы',
                'icon' => Icon::show('users'),
                'url' => Url::to('kr/users'),
            ],*/
            [
                'col' => 3,
                'bg' => 'primary',
                'title' => 'БТИ',
                'description' => 'Для сотрудников БТИ',
                'icon' => Icon::show('microchip'),
                'url' => Url::to('news'),
            ],
            [
                'col' => 3,
                'bg' => 'primary',
                'title' => 'IT',
                'description' => 'Для сотрудников IT',
                'icon' => Icon::show('laptop'),
                'url' => Url::to('news'),
            ],
            [
                'col' => 3,
                'bg' => 'primary',
                'title' => 'B2B',
                'description' => 'Для сотрудников B2B',
                'icon' => Icon::show('briefcase'),
                'url' => Url::to('news'),
            ],
            [
                'col' => 3,
                'bg' => 'primary',
                'title' => 'B2C',
                'description' => 'Для сотрудников B2C',
                'icon' => Icon::show('building'),
                'url' => Url::to('news'),
            ],
        ];
        return $this->render('index',
            [
                'items' => $items,
                'imgs' => $imgs,
            ]);
    }
}
