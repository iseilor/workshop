<?php

namespace app\modules\user\controllers;

use app\modules\user\models\Spouse;
use app\modules\user\models\SpouseSearch;
use app\modules\user\models\User;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SpouseController implements the CRUD actions for Spouse model.
 */
class SpouseController extends Controller
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
     * Lists all Spouse models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Spouse model.
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
     * Creates a new Spouse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Spouse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        // Ставим пол супруге на противоположные
        $user = User::findOne(Yii::$app->user->identity->id);
        if ($user->gender == 1) {
            $model->gender = 0;
        } else {
            $model->gender = 1;
        }

        // Данные по адресу берём из сотрудника
        $model->passport_registration = $user->passport_registration;
        $model->address_fact = $user->address_fact;


        return $this->render('create', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing Spouse model.
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
        $user = User::findOne($model->user_id);

        return $this->render('update', [
            'model' => $model,
            'user'=>$user
        ]);
    }

    /**
     * Deletes an existing Spouse model.
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
     * Finds the Spouse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Spouse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Spouse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    // Выгрузить согласие на обработку персональных данных
    public function actionPd($id)
    {
        $user = Spouse::findOne($id);
        $filePath = Yii::getAlias('@app') . '/modules/user/files/user_personal_data.docx';
        $templateProcessor = new TemplateProcessor($filePath);
        $templateProcessor->setValue(
            [
                'FIO',
                'PASSPORT_SERIES',
                'PASSPORT_NUMBER',
                'PASSPORT_DATE',
                'PASSPORT_DEPARTMENT',
                'PASSPORT_CODE',
                'PASSPORT_REGISTRATION',
                'DATE',
                'FIO2'
            ],
            [
                $user->fio,
                $user->passport_series,
                $user->passport_number,
                date('d.m.Y', $user->passport_date),
                $user->passport_department,
                $user->passport_code,
                $user->passport_registration,
                date('d.m.Y'),
                $user->getFioShortDocx()
            ]
        );
        $fileUrl = '/files/spouse/' . $id . '/spouse_' . $id . '_pd_' . date('YmdHis') . '.docx';
        $templateProcessor->saveAs(Yii::getAlias('@app') . '/web' . $fileUrl);
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . $fileUrl);
    }
}
