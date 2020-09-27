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
            'Mikhail.Biryukov@rt.ru',
            'Petr.Zabrodin@rt.ru',
            'petr.a.ivanov@rt.ru',
            'Galina_Semko@center.rt.ru',
            'Andrey.Krayko@RT.RU',
            'Vladimir_Kudenko@center.rt.ru',
            'Andrey.A.Kulikov@rt.ru',
            'aleksandr.lomakin@rt.ru',
            'Aleksey.Ryumin@rt.ru',
            'serman@center.rt.ru',
            'Stanislav.Tikhonov@RT.RU',
            'Aleksey.Chikashov@RT.RU',
            'Vadim.Chuprikov@rt.ru',
            'vladimir.shepping@rt.ru',
            'Anton.Bykovskiy@rt.ru',
            'Artem.Golovkin@rt.ru',
            'Igor.Zavorotnyy@rt.ru',
            'Ekaterina.Krasikova@RT.RU',
            'Dmitriy.S.Nazarov@RT.RU',
            'Rustam.Nuriev@rt.ru',
            'elena_pronjkina@center.rt.ru',
            'elena_golnyak@center.rt.ru',
            'olga.protasova@center.rt.ru',
            'irina.r.bondareva@rt.ru',
            'Nikolay_Kolokolchikov@center.rt.ru',
            'konstantin_grebenkin@center.rt.ru',
            'Dmitriy_Ovsyannikov@center.rt.ru',
            'Vladimir_Rogachev@center.rt.ru',
            'olga_zavadskaya@center.rt.ru',
            'viktor_chervitskiy@rt.ru',
            'Sergey_Petrov@center.rt.ru',
            'mariya_mamatova@center.rt.ru',
            'Alexey_Samolovcev@center.rt.ru',
            'Roman.Razinkov@center.rt.ru',
            'elena.vorfolomeeva@center.rt.ru',
            'evgeniy_a_turischev@center.rt.ru',
            'a_mosichkin@rt.ru',
            'yuliya_zolotareva@center.rt.ru',
            'Natalya_Pecherskaya@center.rt.ru',
            'darjya_egorkina@center.rt.ru',
            's.n.efimova@center.rt.ru',
            'vladimir_lipunov@rt.ru',
            'darya_telysheva@center.rt.ru',
            'vadim_olifirovich@center.rt.ru',
            'Ekaterina_Kovalenko@center.rt.ru',
            'Mikhail.Trufanov@center.rt.ru',
            'Nina.Panova@center.rt.ru',
            'zhanna_klinyshkova@center.rt.ru',
            'viktoriya.nikeytseva@rt.ru',
            'S_V_Martynov@center.rt.ru',
            'olga_lyubitskaya@center.rt.ru',
            'Aleksey_Slepokurov@center.rt.ru',
            't.n.tochilova@center.rt.ru',
            'anna_zelenkina@center.rt.ru',
            'Artem_Mazaev@center.rt.ru',
            'Darya.Beregovaya@rt.ru',
            'svetlana_nikolaeva@center.rt.ru',
            'olga_fatieva@center.rt.ru',
            'igor_vilyamov@center.rt.ru',
            'dmitriy_lybin@center.rt.ru',
            'Mikhail.Aleksandrov@center.rt.ru',
            'Sergey_V_Volkov@center.rt.ru',
            'konstantin_budnikov@center.rt.ru',
            'mikhail_shcherbakov@center.rt.ru',
            'Andrey_Pozdnyakov@center.rt.ru',
            'Pavel_Gordeev@center.rt.ru',
            'Andrey_Shvoev@center.rt.ru',
            'Alexey_Kiselev@center.rt.ru',
            'Andrey_Pautov@center.rt.ru',
            'vladimir_m_nadraliev@center.rt.ru',
            'oleg_g_naumov@center.rt.ru',
            'vladimir_yu_popelnuschenko@center.rt.ru',
            'aleksandr.sudeykin@rt.ru',
            'Anton_Pekanov@center.rt.ru',
            'Aleksey.Gorkovenko@RT.RU',
            'andrey_kirillov@center.rt.ru',
            'Natalya.Voronova@RT.RU',
            'Evgeniya.Akhmetova@RT.RU',
            'olga.kogoyakova@rt.ru',
            'E.Y.Ovchinnikova@rt.ru',
            'Aleksandr.Ustinov@rt.ru',
            'Pavel.Kobylchenko@rt.ru',
            'Ayna.Shayukova@RT.RU',
            'Sergey.Belyaev@RT.RU',
            'nikolay.biktimirkin@center.rt.ru',
            'Aleksandr.Minyashkin@RT.RU',
            'Ilukhin@center.rt.ru',
            'dmitriy.a.turkov@rt.ru',
        ];
        foreach ($emails as $email) {
            $ad->createUserByEmail($email);
            echo 'Пользователь с почтой ' . $email . ' успешно создан' . PHP_EOL;
        }
        echo 'Пользователи успешно заведены' . PHP_EOL;
    }
}