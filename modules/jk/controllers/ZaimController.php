<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Min;
use app\modules\jk\models\Percent;
use app\modules\user\models\User;
use Yii;
use app\modules\jk\models\Zaim;
use app\modules\jk\models\ZaimSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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

        // Прожиточный минимум
        $mins = Min::find()->orderBy('title')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
                'mins' => $mins
            ]
        );
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

        // Прожиточный минимум
        $mins = Min::find()->orderBy('title')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

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

    // Рассчитать
    public function actionCalc()
    {
        $zaim = new Zaim();
        $zaim->load(Yii::$app->request->post());

        // Текущий пользователь
        $user = User::findOne(Yii::$app->user->identity->getId());

        // Прожиточный минимум в регионе покупки жилья
        $min = Min::findOne($zaim->min_id);

        // Максимальный срок займа
        $maxYears = 10;
        if ($zaim->family_income > 35000) {
            $maxYears = 7;
        } else {
            if ($zaim->family_income > 25000) {
                $maxYears = 8;
            } else {
                if ($zaim->family_income > 15000) {
                    $maxYears = 10;
                } else {
                    $maxYears = 10;
                }
            }
        }

        // Если лет до пенсии меньше, чем максимальный срок займа, то срок займа сокращаем до срока пенсии
        $pensionYears = $user->getPensionYears();
        if ($pensionYears < $maxYears) {
            $maxYears = $pensionYears;
        }

        // Если доход, меньше прожиточного минимума
        if ($zaim->family_income < $min->min) {
            return $this->renderPartial(
                'result_error',
                [
                    'message' => "<strong>Среднемесячный доход на одного члена вашей семьи</strong> меньше прожиточного минимума в регионе, в котором
                    вы приобритаете квартиру (<strong>" . $min->title . ", прожиточный минимум: " . Yii::$app->formatter->format($min->min, 'decimal') . " руб</strong>). Проверьте указанные вами данные, если вы всё указали 
            корректно, то обязательно свяжитесь
                    с модератором модуля, мы постараемся вам помочь в улучшении вашего материального положения"
                ]
            );
        }

        // Максимальный размер займа (Вариант 1)
        $maxMoney1 = ($zaim->family_income - $min->min) * $zaim->family_count * $maxYears * 12;

        // Корпоративная норма площади жилья KNP
        $KNP = 35; // Корпоративная норма в метрах
        if ($zaim->family_count == 1) {
            $KNP = 35;
        } else {
            if ($zaim->family_count == 2) {
                $KNP = 50;
            } else {
                $KNP = 20 * $zaim->family_count;
            }
        }

        // Проверка
        if ($zaim->cost_total < $zaim->cost_user + $zaim->bank_credit){
            return $this->renderPartial(
                'result_error',
                [
                    'message' => "Полная стоимость жилья не может быть меньше суммы собственных средств работника и кредита в банке"
                ]
            );
        }

        // Коэффициент
        $koef = $KNP / ($zaim->area_buy - $zaim->cost_user * $zaim->area_buy / $zaim->cost_total);
        $koef = min($koef, 1);

        // Максимальный размер займа (Вариант 2)
        $maxMoney2 = $koef * ($zaim->cost_total - $zaim->cost_user - $zaim->bank_credit);


        // Выбираем минимальное значение или 1 млн рублей
        $maxMoney = min($maxMoney1, $maxMoney2, 1000000);

        return $this->renderPartial(
            'result_success',
            [
                'maxYears' => $maxYears,
                'maxMoney' => $maxMoney
            ]
        );
    }

    // Отправить письмо
    public function actionSendEmail(){
        $model = new Zaim();
        $model->load(Yii::$app->request->post());

        $user = User::findOne(Yii::$app->user->identity->getId());
        $model->gender=$user->gender;
        $model->date_birth=$user->birth_date;
        $model->experience=$user->getExperience();

        return Yii::$app->mailer->compose('@app/modules/jk/mails/zaim',
                                          [
                                              'model' => $model,
                                              'user'=>$user
                                          ])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->id])
            ->setTo($user->email)
            ->setSubject('WORKSHOP / Жилищная компания / Калькулятор займа')
            ->send();
    }
}
