<?php

namespace app\modules\user\controllers;


use app\modules\jk\models\OrderSearch;
use app\modules\jk\models\PercentSearch;
use app\modules\jk\models\ZaimSearch;
use app\modules\user\forms\PasswordChangeForm;
use app\modules\user\forms\ProfileUpdateForm;
use app\modules\user\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

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

        $userId = Yii::$app->user->identity->id;

        // Проценты текущего пользователя
        $percentSearchModel = new PercentSearch();
        $percentDataProvider = $percentSearchModel->search(['PercentSearch'=>['created_by' => $userId]]);

        // Займы текущего пользователя
        $zaimSearchModel = new ZaimSearch();
        $zaimDataProvider = $zaimSearchModel->search(['ZaimSearch'=>['created_by' => $userId]]);

        // Заявки текущего пользователя
        $orderSearchModel = new OrderSearch();
        $orderDataProvider = $orderSearchModel->search(['OrderSearch'=>['created_by' => $userId]]);

        $model = $this->findModel();

        // Файлы
        $model->photo = Yii::$app->homeUrl.Yii::$app->params['module']['user']['photo']['path'] . $model->photo;

        if (isset($model->gender)) {
            switch ($model->gender) {
                case 0:
                    $model->gender = 'Женский';
                    break;
                case 1:
                    $model->gender = 'Мужской';
                    break;
            }
        }

        $experience='';
        if (isset($model->work_date)){
            $experience = intdiv(mktime() - $model->work_date, 31556926);
        }

        return $this->render(
            'index',
            [
                'model' => $model,
                'experience' => $experience,
                'percentDataProvider' => $percentDataProvider,
                'zaimDataProvider' => $zaimDataProvider,
                'orderDataProvider' => $orderDataProvider,
            ]
        );
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
            //$model->img = UploadedFile::getInstance($model, 'img');
            //$model->upload();
            return $this->redirect(['index']);
            //return $this->goBack();
        } else {
            return $this->render(
                'update/update',
                [
                    'model' => $model,

                ]
            );
        }
    }

    public function actionPasswordChange()
    {
        $user = $this->findModel();
        $model = new PasswordChangeForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            return $this->redirect(['index']);
        } else {
            return $this->render(
                'passwordChange',
                [
                    'model' => $model,
                ]
            );
        }
    }
}