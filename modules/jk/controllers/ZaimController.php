<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Min;
use app\modules\jk\models\Zaim;
use app\modules\jk\models\ZaimSearch;
use app\modules\user\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

/**
 * ZaimController implements the CRUD actions for Zaim model.
 */
class ZaimController extends Controller
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
     * Lists all Zaim models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZaimSearch();
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
     * Displays a single Zaim model.
     * @param integer $id
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
     * Creates a new Zaim model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zaim();

        // Пользователья
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

        // Прожиточный минимум
        $mins = Min::find()->orderBy('title')->all();

        if ($user->getIsJKAccess()) {
            if ($model->experience < 1) {
                Yii::$app->session->setFlash('warning', "К сожалению, вы не можете воспользоваться Жилищной Программой, т.к. ваш общий стаж работы в компании менее 1 года");
                return $this->redirect(['/main/default/index']);
            } elseif ($user->getYears() < 21 || $user->getPensionYears() < 0 ) {
                Yii::$app->session->setFlash('warning', "К сожалению, вы не можете воспользоваться Жилищной Программой из-за ограничений по возрасту");
                return $this->redirect(['/main/default/index']);
            } else {

                Yii::$app->session->setFlash('primary', "Обращаем Ваше внимание, что Калькулятор считает МАКСИМАЛЬНО возможный размер материальной помощи,
                                            без учета  решения жилищной комиссии и утвержденного Бюджета на соответствующий год.
                                            Максимальный размер Займа не может быть больше 1 млн. руб.");
                return $this->render(
                    'create',
                    [
                        'model' => $model,
                        'mins' => $mins
                    ]
                );
            }
        } else {
            Yii::$app->session->setFlash('warning', "Чтобы воспользоваться калькулятором займа вам необходимо заполнить ваш профиль: возраст, пол и дата трудоустройства");
            return $this->redirect(['/user/profile/update']);
        }
    }

    /**
     * Updates an existing Zaim model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        // Ajax-валидация сложных полей
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        // Прожиточный минимум
        $mins = Min::find()->orderBy('title')->all();
        return $this->render(
            'update',
            [
                'model' => $model,
                'mins' => $mins
            ]
        );
    }

    /**
     * Deletes an existing Zaim model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Zaim model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Zaim the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zaim::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app\jk', 'The requested page does not exist.'));
    }


    // Отправить письмо
    public function actionSendEmail()
    {
        $model = new Zaim();
        $model->load(Yii::$app->request->post());

        $user = User::findOne(Yii::$app->user->identity->getId());
        $model->gender = $user->gender;
        $model->date_birth = $user->birth_date;
        $model->experience = $user->getExperience();

        return Yii::$app->mailer->compose(
            '@app/modules/jk/mails/zaim',
            [
                'model' => $model,
                'user' => $user
            ]
        )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->id])
            ->setTo($user->email)
            ->setSubject('WORKSHOP / Жилищная кампания / Калькулятор займа')
            ->send();
    }
}
