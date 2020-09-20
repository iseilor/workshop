<?php

namespace app\modules\kr\controllers;

use app\modules\kr\models\BlockSearch;
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
                'url'=>Url::to('kr/student')
            ],
        ];


        $searchModel = new BlockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['weight' => SORT_ASC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'imgs' => $imgs,
        ]);

    }
}
