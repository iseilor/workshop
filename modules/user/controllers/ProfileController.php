<?php

namespace app\modules\user\controllers;

use app\modules\jk\models\PercentSearch;
use app\modules\jk\models\ZaimSearch;
use app\modules\user\forms\PasswordChangeForm;
use app\modules\user\forms\ProfileUpdateForm;
use app\modules\user\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class ProfileController extends Controller
{

    public function behaviors()
    {
        return [
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

    public function actionIndex()
    {
        $percentSearchModel = new PercentSearch();
        $percentDataProvider = $percentSearchModel->search(Yii::$app->request->queryParams);

        $zaimSearchModel = new ZaimSearch();
        $zaimDataProvider = $zaimSearchModel->search(Yii::$app->request->queryParams);

        $model = $this->findModel();
        switch ($model->gender) {
            case 0:
                $model->gender='Женский';
                break;
            case 1:
                $model->gender='Мужской';
                break;
            default:
                $model->gender='Не определён';
                break;
        }
        $experience=intdiv(mktime()-$model->work_date,31556926);


        return $this->render('index', [
            'model' => $model,
            'experience'=>$experience,
            'percentSearchModel' => $percentSearchModel,
            'percentDataProvider' => $percentDataProvider,
            'zaimSearchModel' => $zaimSearchModel,
            'zaimDataProvider' => $zaimDataProvider,
        ]);
    }

    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }

    public function actionUpdate()
    {
        $user = $this->findModel();
        $model = new ProfileUpdateForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionPasswordChange()
    {
        $user = $this->findModel();
        $model = new PasswordChangeForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('passwordChange', [
                'model' => $model,
            ]);
        }
    }
}