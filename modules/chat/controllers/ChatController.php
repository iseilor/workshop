<?php

namespace app\modules\chat\controllers;

use app\modules\chat\models\Chat;
use app\modules\chat\models\ChatSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Chat models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chat model.
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
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Chat model.
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
     * Deletes an existing Chat model.
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
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    // Отправить сообщение
    public function actionSend()
    {
        $model = new Chat();
        $model->load(Yii::$app->request->post());
        $model->group_id = 1;
        $model->save();

        return 1;
    }

    // Получить список сообщений
    public function actionList()
    {
        $searchModel = new ChatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->renderPartial('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // Получить сообщения за последние time-секунд
    public function actionMessages($time)
    {
        $now = time();
        $messages = Chat::find()
            ->select('message, user.fio')
            ->where(['>=', 'chat.created_at', $now - $time])
            ->andWhere('chat.created_by!='.Yii::$app->user->identity->id)
            ->leftJoin('user', 'user.id = chat.created_by')
            ->asArray()
            ->all();
        echo json_encode($messages);
    }
}
