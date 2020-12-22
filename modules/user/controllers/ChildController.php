<?php

namespace app\modules\user\controllers;

use app\modules\user\models\Child;
use app\modules\user\models\ChildSearch;
use app\modules\user\models\Spouse;
use app\modules\user\models\User;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
                'class' => VerbFilter::class,
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
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['ChildSearch']['user_id'] = Yii::$app->user->identity->id;

        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->query->andWhere(['deleted_at' => null]);

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
    public function actionCreate($userId)
    {
        $model = new Child();
        $model->gender = 0; // Пока по запросу Лады не собираем данные по полу. Но вообще это нужно будет потом

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        // Данные по адресу берём из родителя
        //$user = User::findOne(Yii::$app->user->identity->id);
        $user = User::findOne($userId);
        $spouse = Spouse::findOne(['user_id' => $user->id]);
        if (!$spouse) {
            $spouse = new Spouse();
        }
        $model->address_registration = $user->passport_registration;
        $model->address_fact = $user->address_fact;

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
            'spouse' => $spouse,
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

        $user = User::findOne($model->user_id);
        $spouse = Spouse::findOne(['user_id' => $user->id]);
        if (!$spouse) {
            $spouse = new Spouse();
        }
        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'spouse' => $spouse,
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
        if (Yii::$app->request->isAjax) {
            return $this->renderList();
        } else {
            return $this->redirect(['index']);
        }
    }

    protected function renderList()
    {
        $searchModel = new ChildSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['ChildSearch']['user_id'] = Yii::$app->user->identity->id;

        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->query->andWhere(['deleted_at' => null]);

        $method = Yii::$app->request->isAjax ? 'renderAjax' : 'render';

        return $this->$method('grid-view', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

        // Разные файлы до 18 лет и после
        if ($child->age >= 18) {
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
                    $child->fio,
                    $child->passport_series,
                    $child->passport_number,
                    date('d.m.Y', $child->passport_date),
                    $child->passport_department,
                    $child->passport_code,
                    $child->address_registration,
                    date('d.m.Y'),
                    $user->surname . ' ' . $user->initials
                ]
            );
        } else {
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
                    'BIRTH_SERIES',
                    'BIRTH_NUMBER',
                    'BIRTH_DEPARTMENT',
                    'BIRTH_CODE',
                    'BIRTH_DATE',
                    'ADDRESS_REGISTRATION',
                    'CHILD_DATE',

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

                    $child->fio,
                    $child->birth_series,
                    $child->birth_number,
                    $child->birth_department,
                    $child->birth_code,
                    date('d.m.Y', $child->birth_date),
                    $child->address_registration,
                    date('d.m.Y', $child->date),

                    date('d.m.Y'),
                    $user->surname . ' ' . $user->initials
                ]
            );
        }

        $fileUrl = '/files/child/' . $id . '/' . $id . '_pd_' . date('YmdHis') . '.docx';
        $templateProcessor->saveAs(Yii::getAlias('@app') . '/web' . $fileUrl);
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . $fileUrl);
    }
}
