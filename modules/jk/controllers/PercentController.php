<?php

namespace app\modules\jk\controllers;

use app\modules\user\models\User;
use Yii;
use app\modules\jk\models\Percent;
use app\modules\jk\models\PercentSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

    // Рассчитать
    public function actionCalc()
    {
        $percent = new Percent();
        $percent->load(Yii::$app->request->post());

        // Максимальный срок компенсации процентов (кол-во лет до пенсии, но не более 10 лет)
        $user = User::findOne(Yii::$app->user->identity->getId());
        $maxPercentYears = $user->getPensionYears();
        if ($maxPercentYears > 10) {
            $maxPercentYears = 10;
        }
        if ($maxPercentYears < 0) {
            $maxPercentYears = 0;
        }

        // Ставка компенсации процентов SKP
        $SKP = 12;
        if ($user->getYears() <= 35) {
            if ($percent->family_income > 35000) {
                $SKP = 6;
            } elseif ($percent->family_income > 25000) {
                $SKP = 8;
            } elseif ($percent->family_income > 15000) {
                $SKP = 10;
            } else {
                $SKP = 12;
            }
        } else {
            if ($percent->family_income > 35000) {
                $SKP = 4;
            } elseif ($percent->family_income > 25000) {
                $SKP = 6;
            } elseif ($percent->family_income > 15000) {
                $SKP = 8;
            } else {
                $SKP = 10;
            }
        }

        // Корпоративная норма площади жилья KNP
        $KNP = 35; // Корпоративная норма в метрах
        if ($percent->family_count == 1) {
            $KNP = 35;
        } else {
            if ($percent->family_count == 2) {
                $KNP = 50;
            } else {
                $KNP = 20 * $percent->family_count;
            }
        }

        // Коэффициент учёта корпоративной нормы KUKN
        $KUKN = $KNP / ($percent->area_buy - ($percent->cost_user / $percent->cost_total * $percent->area_buy));



        if ($KUKN > 1) {
            $KUKN = 1;
        }
        $maxPercentMoney = round($percent->percent_count * ($SKP / $percent->percent_rate) * $KUKN, -3);


        return $this->renderPartial(
            'result_success',
            [
                'maxPercentYears' => $maxPercentYears,
                'maxPercentMoney' => $maxPercentMoney
            ]
        );
    }

    // Отправить письмо
    public function actionSendEmail(){
        $model = new Percent();
        $model->load(Yii::$app->request->post());
        $user = User::findOne(Yii::$app->user->identity->getId());

        $model->gender=$user->gender;
        $model->date_birth=$user->birth_date;
        $model->experience=$user->getExperience();

        return Yii::$app->mailer->compose('@app/modules/jk/mails/percent',
            [
                'model' => $model,
                'user'=>$user
            ])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->id])
            ->setTo($user->email)
            ->setSubject('WORKSHOP / ЖК / Калькулятор процентов')
            ->send();
    }
}
