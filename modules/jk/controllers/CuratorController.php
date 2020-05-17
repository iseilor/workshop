<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Message;
use app\modules\user\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `jk` module
 */
class CuratorController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Message();

        // История переписк конкретного пользователя
        $messagesQuery = Message::find()->where(['user_id' => Yii::$app->user->identity->id]);
        $messagesDataProvider = new ActiveDataProvider([
            'query' => $messagesQuery,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_ASC,
                ],
            ],
        ]);

        return $this->render('index', [
            'model' => $model,
            'messageDataProvider' => $messagesDataProvider,
        ]);
    }

    // Отправка сообщений
    public function actionSend()
    {
        $model = new Message();
        $model->load(Yii::$app->request->post());
        $model->user_id = Yii::$app->user->identity->id;
        $model->is_curator = false;
        $model->save();
        $model->sendEmail2Curator(); // Отправляем сообщение куратору
        return false;
    }


}