<?php

namespace app\modules\jk\controllers;

use app\modules\jk\Module;
use app\modules\user\models\User;
use Yii;
use app\modules\jk\models\Percent;
use app\modules\jk\models\PercentSearch;
use yii\filters\AccessControl;
use yii\httpclient\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * PercentController implements the CRUD actions for Percent model.
 */
class PercentController extends Controller
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
     * Lists all Percent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PercentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single Percent model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Percent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Percent();

        $user = User::findOne(Yii::$app->user->identity->getId());
        $model->date_birth = $user->birth_date;
        $model->gender = $user->gender;
        $model->experience = $user->getExperience();

        // Ajax-валидация сложных полей
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        // Не проходит по стажу
        if ($model->experience < 1) {
            Yii::$app->session->setFlash('warning', "К сожалению, вы не можете воспользоваться Жилищной Программой, т.к. ваш общий стаж работы в компании менее 1 года");
            return $this->redirect(['/main/default/index']);
        } else {
            if ($user->getIsJKAccess()) {
                return $this->render(
                    'create',
                    [
                        'model' => $model,
                    ]
                );
            } else {
                Yii::$app->session->setFlash('warning', "Чтобы воспользоваться калькулятором компенсации процентов вам необходимо дозаполнить ваш профиль: возраст, пол и дата трудоустройства");
                return $this->redirect(['/user/profile/update']);
            }
        }
    }


    /**
     * Updates an existing Percent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }


    /**
     * Deletes an existing Percent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Percent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Percent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Percent::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app\jk', 'The requested page does not exist.'));
    }


    // Отправить письмо
    public function actionSendEmail()
    {
        $model = new Percent();
        $model->load(Yii::$app->request->post());
        $user = User::findOne(Yii::$app->user->identity->getId());

        $model->gender = $user->gender;
        $model->date_birth = $user->birth_date;
        $model->experience = $user->getExperience();

        return Yii::$app->mailer->compose(
            '@app/modules/jk/mails/percent',
            [
                'model' => $model,
                'user' => $user
            ]
        )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->id])
            ->setTo($user->email)
            ->setSubject('WORKSHOP / Жилищная компания / Калькулятор процентов')
            ->send();
    }
}
