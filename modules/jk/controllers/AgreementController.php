<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Agreement;
use app\modules\jk\models\AgreementSearch;
use app\modules\jk\models\Order;
use app\modules\jk\models\Status;
use app\modules\user\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AgreementController implements the CRUD actions for Agreement model.
 */
class AgreementController extends Controller
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
     * Lists all Agreement models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgreementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agreement model.
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
     * Creates a new Agreement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agreement();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Agreement model.
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
     * Согласование заявки
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCheck($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post()) {
            $model->approval = $_POST['approval'];
            $model->approval_at = time();
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Если успешно согласовано
            if ($model->approval==Agreement::APPROVAL_YES) {
                $model->sendEmailUserManagerSuccess();              // Письмо сотруднику, что заявка согласована
                Agreement::sendEmailManager($model->order_id);      // Письмо следующем руководителю
            } else {
                $model->sendEmailUserManagerDanger();               // Письмо сотруднику, что не согласовано

                // Ставим статус, что заявка не согласована
                $order = Order::findOne($model->order_id);
                $order->status_id=Status::findOne(['code'=>'MANAGER_NO'])->id;
                $order->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $order = Order::findOne($model->order_id);
        $user = User::findOne($model->created_by);
        $agreementSearchModel = new AgreementSearch();
        $agreementDataProvider = $agreementSearchModel->search(['AgreementSearch'=>['order_id' => $order->id]]);
        return $this->render('check', [
            'model' => $model,
            'order' => $order,
            'user'  => $user,
            'agreementDataProvider'=>$agreementDataProvider
        ]);
    }

    /**
     * Deletes an existing Agreement model.
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
     * Finds the Agreement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Agreement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agreement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
