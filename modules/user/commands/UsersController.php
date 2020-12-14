<?php

namespace app\modules\user\commands;

use app\modules\user\models\Ad;
use app\modules\user\models\User;
use yii\base\Model;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\Console;

class UsersController extends Controller
{

    public function actionIndex()
    {
        echo 'yii users/create' . PHP_EOL;
        echo 'yii users/remove' . PHP_EOL;
        echo 'yii users/activate' . PHP_EOL;
        echo 'yii users/change-password' . PHP_EOL;
    }

    public function actionCreate()
    {
        $model = new User();
        $this->readValue($model, 'username');
        $this->readValue($model, 'email');
        $model->setPassword($this->prompt('Password:', [
            'required' => true,
            'pattern' => '#^.{6,255}$#i',
            'error' => 'More than 6 symbols',
        ]));
        $model->generateAuthKey();
        $this->log($model->save());
    }

    public function actionRemove()
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $model = $this->findModel($username);
        $this->log($model->delete());
    }

    public function actionActivate()
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $model = $this->findModel($username);
        $model->status = User::STATUS_ACTIVE;
        $model->removeEmailConfirmToken();
        $this->log($model->save());
    }

    public function actionChangePassword()
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $model = $this->findModel($username);
        $model->setPassword($this->prompt('New password:', [
            'required' => true,
            'pattern' => '#^.{6,255}$#i',
            'error' => 'More than 6 symbols',
        ]));
        $this->log($model->save());
    }

    /**
     * @param string $username
     *
     * @return User the loaded model
     * @throws \yii\console\Exception
     */
    private function findModel($username)
    {
        if (!$model = User::findOne(['username' => $username])) {
            throw new Exception('User not found');
        }
        return $model;
    }

    /**
     * @param Model  $model
     * @param string $attribute
     */
    private function readValue($model, $attribute)
    {
        $model->$attribute = $this->prompt(mb_convert_case($attribute,
                MB_CASE_TITLE, 'utf-8') . ':', [
            'validator' => function ($input, &$error) use ($model, $attribute) {
                $model->$attribute = $input;
                if ($model->validate([$attribute])) {
                    return true;
                } else {
                    $error = implode(',', $model->getErrors($attribute));
                    return false;
                }
            },
        ]);
    }

    /**
     * @param bool $success
     */
    private function log($success)
    {
        if ($success) {
            $this->stdout('Success!', Console::FG_GREEN, Console::BOLD);
        } else {
            $this->stderr('Error!', Console::FG_RED, Console::BOLD);
        }
        echo PHP_EOL;
    }

    // Создание пользователей по списку email
    public function actionCreate2()
    {
        $ad = new Ad();
        $emails = [
            'Natalya.Khayan@RT.RU',
            'Anna_Belikova@center.rt.ru',
            'Ludmila.Belikova@center.rt.ru',
            'irina_varlamova@center.rt.ru',
            'Elena_A_Kadushkina@center.rt.ru',
            'Evgeniy_Krasavin@center.rt.ru',
            'Galina_Chaplygina@center.rt.ru',
            'Olga_Nikolaeva@center.rt.ru',
            'n.k.novikova@center.rt.ru',
            'Marina_Gryaznova@center.rt.ru',
            'Elena_L_Larionova@center.rt.ru',
            'irina_karachentseva@center.rt.ru',
            'Oljga_Kozlova@center.rt.ru'
        ];
        foreach ($emails as $email) {
            $ad->createUserByEmail($email);
            echo 'Пользователь с почтой ' . $email . ' успешно создан' . PHP_EOL;
        }
        echo 'Пользователи успешно заведены' . PHP_EOL;
    }
}