<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Message;
use app\modules\jk\models\MessageSearch;
use app\modules\user\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
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
        ];
    }

    /**
     * Lists all Message models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // По умолчанию
        $user = false;
        $messagesDataProvider = false;

        // Получаем все записи с группированные по пользователям
        $messagesGroup = Message::find()
            ->select(['max(id) as max','user_id','count(*) as cnt'])
            ->groupBy(['user_id'])
            ->all();
        $userLastMessage = ArrayHelper::map($messagesGroup, 'user_id', 'max');
        $userMessagesCount =  ArrayHelper::map($messagesGroup, 'user_id', 'cnt');
        $messagesCurator = Message::find()->select('*')->WHERE(['in', 'id', $userLastMessage]) ->andWhere(['is_curator'=>true])->all();
        $messagesUser = Message::find()->select('*')->WHERE(['in', 'id', $userLastMessage]) ->andWhere(['is_curator'=>false])->all();

        // Если открыта переписка с конкретным пользователем
        if (isset($_GET['user'])) {
            $user = User::findOne($_GET['user']);
            $messagesQuery = Message::find()->where(['user_id' => $user->id]);
            $messagesDataProvider = new ActiveDataProvider([
                'query' => $messagesQuery,
                'pagination' => [
                    'pageSize' => 100,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_ASC,
                    ]
                ],
            ]);
        }

        return $this->render('index', [
            'messagesCurator'=>$messagesCurator,
            'messagesUser'=>$messagesUser,
            'userMessagesCount' => $userMessagesCount,
            'user'=>$user,
            'messagesDataProvider'=>$messagesDataProvider,
            'message'=>   new Message()
        ]);
    }

    /**
     * Displays a single Message model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Message model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    // Отправка сообщений
    public function actionSend(){
        $model = new Message();
        $model->load(Yii::$app->request->post());
        $model->is_curator = true;
        $model->save();
        $model->sendEmail2User(); // Отрпавляем письмо сотруднику
        return false;
    }
}
