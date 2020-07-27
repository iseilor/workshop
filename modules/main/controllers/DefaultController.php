<?php

namespace app\modules\main\controllers;

use app\modules\jk\Module;
use app\modules\main\models\ContactForm;
use app\modules\news\models\NewsSearch;
use app\modules\user\models\User;
use DateTime;
use kartik\icons\Icon;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `main` module
 */
class DefaultController extends Controller
{

    public $title;

    public function behaviors()
    {
        return [
            'access' => [
                'only' => ['feedback'],
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['feedback'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {

        $list = [
            [
                'col' => 3,
                'bg' => 'primary',
                'title' => 'Новости',
                'description' => 'Всегда свежая информация',
                'icon' => Yii::$app->params['module']['news']['icon'],
                'url' => Url::to('news'),
                'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
            ],
            [
                'col' => 3,
                'bg' => 'indigo',
                'title' => Module::t('module', 'JK'),
                'description' => Module::t('module', 'jk'),
                'icon' => Yii::$app->params['module']['jk']['icon'],
                'url' => Url::to(['/jk/']),
                'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
            ],
            [
                'col' => 3,
                'bg' => 'indigo',
                'title' => 'Пульсар',
                'description' => 'Мониторинг подразделения',
                'icon' => Icon::show('heartbeat'),
                'url' => Url::to(['/pulsar/']),
                'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
            ],
            /* [
                 'col' => 3,
                 'bg' => 'primary',
                 'title' => '<span class="curs">&nbsp;<span class="curs-1"><i class="fas fa-dollar-sign"></i> 66.90</span><span class="curs-2"><i class="fas fa-euro-sign"></i> 73.91</span><span class="curs-3"><i class="fas fa-gas-pump"></i> 49.91</span></span>',
                 'description' => '<span class="curs">&nbsp;<span class="curs-1">USD ЦБ</span><span class="curs-2">EURO ЦБ</span><span class="curs-3">Нефть</span></span>',
                 'icon' => '<i class="fas fa-ruble-sign"></i>',
                 'url' => '#',
                 'link' => 'Курсы ЦБ РФ на ' . Yii::$app->formatter->asDate(new DateTime()),
             ],
             [
                 'col' => 3,
                 'bg' => 'primary',
                 'title' => '+5&degC',
                 'description' => '<i class="fas fa-wind"></i>2-3м/с | <i class="fas fa-tint"></i>78% | <i class="fas fa-tachometer-alt"></i>736ммрт.ст.
 ',
                 'icon' => '<i class="fas fa-temperature-high"></i>',
                 'url' => '#',
                 'link' => 'Москва, Румянцево, БЦ Comcity',
             ],*/
            [
                'col' => 3,
                'bg' => 'success',
                'title' => '<span class="clock">
                                <span class="hou">00</span><span class="del">:</span><span class="min">00</span><span class="del">:</span><span class="sec">00</span>
                            </span>',
                'description' => mb_ucfirst(Yii::$app->formatter->asDate(new DateTime(), 'php:l, d F Y')),
                'icon' => '<i class="far fa-clock"></i>',
                'url' => '#',
                'link' => 'МСК',
            ],

            /*
        [
            'col' => 3,
            'bg' => 'indigo',
            'title' => 'Проекты',
            'description' => 'Задачи и отчёты',
            'icon' => Icon::show('folder-open'),
            'url' => Url::to(['/project/']),
            'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
        ],
        [
            'col' => 3,
            'bg' => 'secondary',
            'title' => 'KPI',
            'description' => 'Ключевые показатели',
            'icon' => Icon::show('thumbs-up'),
            'url' => '#',
            'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
        ],
        [
            'col' => 3,
            'bg' => 'secondary',
            'title' => 'ДМС',
            'description' => 'Медицинское страхование',
            'icon' => Icon::show('notes-medical'),
            'url' => '#',
            'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
        ],
        [
            'col' => 3,
            'bg' => 'secondary',
            'title' => 'Путёвки',
            'description' => 'Курорты и санатории',
            'icon' => '<i class="fas fa-plane"></i>',
            'url' => '#',
            'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
        ],
        [
            'col' => 3,
            'bg' => 'warning',
            'title' => 'Чат',
            'description' => 'Корпоративный чат',
            'icon' => '<i class="fas fa-comments"></i>',
            'url' => Url::to(['/chat'], true),
            'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
        ],
        [
            'col' => 3,
            'bg' => 'danger',
            'title' => 'Admin',
            'description' => 'Панель администратора',
            'icon' => '<i class="fas fa-tools"></i>',
            'url' => Url::to(['/admin/']),
            'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
        ],
        [
            'col' => 3,
            'bg' => 'secondary',
            'title' => 'ПП',
            'description' => 'Пенсионные программы',
            'icon' => '<i class="fas fa-hands-helping"></i>',
            'url' => '#',
            'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
        ],
        [
            'col' => 3,
            'bg' => 'secondary',
            'title' => 'Аварии',
            'description' => 'Нештатные ситуации',
            'icon' => Icon::show(Yii::$app->params['module']['ns']['iconClass']),
            'url' => '#',
            'link' => 'Перейти <i class="fas fa-arrow-circle-right"></i>',
        ],*/

        ];

        // Новости
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);
        $dataProvider->setTotalCount(3);
        $news = $dataProvider->getModels();

        return $this->render(
            'index',
            [
                'list' => $list,
                'news' => $news,
            ]
        );
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionFeedback()
    {
        $model = new ContactForm();
        $post = false;

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            $user = $user = User::findOne(Yii::$app->user->identity->getId());
            $model->name = $user->username;
            $model->email = $user->email;
            $model->fio = $user->fio;
            $post = true;
        }

        if ($post && $model->contact(Yii::$app->params['supportEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render(
                'feedback',
                [
                    'model' => $model,
                ]
            );
        }
    }
}