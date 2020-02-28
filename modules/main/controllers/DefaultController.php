<?php

namespace app\modules\main\controllers;

use app\modules\main\models\ContactForm;
use app\modules\user\models\User;
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
                'class' => AccessControl::className(),
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
            ]
        ];
    }


    public function actionIndex()
    {
        $list = [
            [
                'col' => 3,
                'bg' => 'info',
                'title' => 'Новости',
                'description' => 'Всегда свежая информация',
                'icon' => Yii::$app->params['module']['news']['icon'],
                'link' => Url::to('news')
            ],
            [
                'col' => 3,
                'bg' => 'info',
                'title' => 'Курс',
                'description' => 'Всегда свежая информация',
                'icon' => '<i class="fas fa-ruble-sign"></i>',
                'link' => Url::to('news')
            ],
            [
                'col' => 3,
                'bg' => 'info',
                'title' => 'Погода',
                'description' => 'Всегда свежая информация',
                'icon' => '<i class="fas fa-temperature-high"></i>',
                'link' => Url::to('news')
            ],
            [
                'col' => 3,
                'bg' => 'danger',
                'title' => '00:00',
                'description' => 'Всегда свежая информация',
                'icon' => '<i class="far fa-clock"></i>',
                'link' => Url::to('news')
            ],
        ];
        return $this->render(
            'index',
            [
                'list' => $list
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