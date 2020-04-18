<?php

namespace app\modules\user\controllers;

use app\modules\user\models\User;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use app\modules\user\models\Child;
use app\modules\user\models\ChildSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChildController implements the CRUD actions for Child model.
 */
class ChildController extends Controller
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
     * Lists all Child models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChildSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Child model.
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
     * Creates a new Child model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Child();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Child model.
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
            $model->upload();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Child model.
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
     * Finds the Child model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Child the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Child::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    // Выгрузить согласие на обработку персональных данных
    public function actionPd($id)
    {
        $child = Child::findOne($id);
        $user = User::findOne($child->user_id);

        $filePath = Yii::getAlias('@app') . '/modules/user/files/child_personal_data.docx';
        $templateProcessor = new TemplateProcessor($filePath);
        $templateProcessor->setValue(
            [
                'USER_FIO',
                'PASSPORT_SERIES',
                'PASSPORT_NUMBER',
                'PASSPORT_DATE',
                'PASSPORT_DEPARTMENT',
                'PASSPORT_CODE',
                'PASSPORT_REGISTRATION',
                'CHILD_FIO',
                'CHILD_DATE',
                'DATE',
            ],
            [
                $user->fio,
                $user->passport_series,
                $user->passport_number,
                $user->passport_date,
                $user->passport_department,
                $user->passport_code,
                $user->passport_registration,
                $child->fio,
                $child->date,
                date('d.m.Y'),
            ]
        );
        $fileUrl = '/files/child/' . $id . '/' . $id . '_pd_' . date('YmdHis') . '.docx';
        $templateProcessor->saveAs(Yii::getAlias('@app') . '/web' . $fileUrl);
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . $fileUrl);
    }
}
