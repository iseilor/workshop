<?php

namespace app\modules\pulsar\controllers;

use Yii;
use app\modules\pulsar\models\Pulsar;
use app\modules\pulsar\models\PulsarSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PulsarController implements the CRUD actions for Pulsar model.
 */
class PulsarController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
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
     * Lists all Pulsar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PulsarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pulsar model.
     * @param integer $id
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
     * Creates a new Pulsar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // Создавали пульсар уже сегодня
        $user_id=Yii::$app->user->identity->id;
        $pulsarUserTodayCount = count(Pulsar::find()->where('created_by='.$user_id.' and created_at>='.strtotime(date('d.m.Y')))->all());

        if ($pulsarUserTodayCount>0){
            $id = Pulsar::find()->where('created_by='.$user_id.' and created_at>='.strtotime(date('d.m.Y')))->max('id');
            $model = $this->findModel($id);
            Yii::$app->session->setFlash('info', "Вы сегодня уже заполнили Пульсар");
            return $this->render('disable', [
                'model' => $model,
            ]);
        }else{
            $model = new Pulsar();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //return $this->redirect(['view', 'id' => $model->id]);
                Yii::$app->session->setFlash('success', "Спасибо. Ваш пульсар успешно сохранён");
                return $this->render('disable', [
                    'model' => $model,
                ]);
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Pulsar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing Pulsar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pulsar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pulsar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pulsar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
