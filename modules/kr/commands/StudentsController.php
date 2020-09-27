<?php

namespace app\modules\kr\commands;

use app\modules\kr\models\Student;
use app\modules\user\models\User;
use yii\console\Controller;

class StudentsController extends Controller
{

    public function actionIndex()
    {
        echo 'index';
    }


    /**
     * Массовое добавление участников программы
     * При запуске нужно отключить KRAsset::register(Yii::$app->view);
     * Отлючить: TimestampBehavior
     *
     */
    public function actionCreate()
    {
        $students = [
            'Mikhail.Biryukov@rt.ru' => 1,
            'Petr.Zabrodin@rt.ru' => 1,
            'petr.a.ivanov@rt.ru' => 1,
            'Galina_Semko@center.rt.ru' => 1,
            'Andrey.Krayko@RT.RU' => 1,
            'Vladimir_Kudenko@center.rt.ru' => 1,
            'Andrey.A.Kulikov@rt.ru' => 1,
            'aleksandr.lomakin@rt.ru' => 1,
            'Aleksey.Ryumin@rt.ru' => 1,
            'serman@center.rt.ru' => 1,
            'Stanislav.Tikhonov@RT.RU' => 1,
            'Aleksey.Chikashov@RT.RU' => 1,
            'Vadim.Chuprikov@rt.ru' => 1,
            'vladimir.shepping@rt.ru' => 1,
            'Anton.Bykovskiy@rt.ru' => 4,
            'Artem.Golovkin@rt.ru' => 4,
            'Igor.Zavorotnyy@rt.ru' => 4,
            'Ekaterina.Krasikova@RT.RU' => 4,
            'Dmitriy.S.Nazarov@RT.RU' => 4,
            'Rustam.Nuriev@rt.ru' => 4,
            'elena_pronjkina@center.rt.ru' => 4,
            'elena_golnyak@center.rt.ru' => 3,
            'olga.protasova@center.rt.ru' => 3,
            'irina.r.bondareva@rt.ru' => 3,
            'Nikolay_Kolokolchikov@center.rt.ru' => 3,
            'konstantin_grebenkin@center.rt.ru' => 3,
            'Dmitriy_Ovsyannikov@center.rt.ru' => 3,
            'Vladimir_Rogachev@center.rt.ru' => 3,
            'olga_zavadskaya@center.rt.ru' => 3,
            'viktor_chervitskiy@rt.ru' => 3,
            'Sergey_Petrov@center.rt.ru' => 3,
            'mariya_mamatova@center.rt.ru' => 3,
            'Alexey_Samolovcev@center.rt.ru' => 3,
            'Roman.Razinkov@center.rt.ru' => 3,
            'elena.vorfolomeeva@center.rt.ru' => 3,
            'evgeniy_a_turischev@center.rt.ru' => 3,
            'a_mosichkin@rt.ru' => 3,
            'yuliya_zolotareva@center.rt.ru' => 3,
            'Natalya_Pecherskaya@center.rt.ru' => 3,
            'darjya_egorkina@center.rt.ru' => 3,
            's.n.efimova@center.rt.ru' => 3,
            'vladimir_lipunov@rt.ru' => 3,
            'darya_telysheva@center.rt.ru' => 3,
            'vadim_olifirovich@center.rt.ru' => 3,
            'Ekaterina_Kovalenko@center.rt.ru' => 3,
            'Mikhail.Trufanov@center.rt.ru' => 3,
            'Nina.Panova@center.rt.ru' => 3,
            'zhanna_klinyshkova@center.rt.ru' => 3,
            'viktoriya.nikeytseva@rt.ru' => 3,
            'S_V_Martynov@center.rt.ru' => 3,
            'olga_lyubitskaya@center.rt.ru' => 3,
            'Aleksey_Slepokurov@center.rt.ru' => 3,
            't.n.tochilova@center.rt.ru' => 3,
            'anna_zelenkina@center.rt.ru' => 3,
            'Artem_Mazaev@center.rt.ru' => 3,
            'Darya.Beregovaya@rt.ru' => 3,
            'svetlana_nikolaeva@center.rt.ru' => 3,
            'olga_fatieva@center.rt.ru' => 3,
            'igor_vilyamov@center.rt.ru' => 2,
            'dmitriy_lybin@center.rt.ru' => 2,
            'Mikhail.Aleksandrov@center.rt.ru' => 2,
            'Sergey_V_Volkov@center.rt.ru' => 2,
            'konstantin_budnikov@center.rt.ru' => 2,
            'mikhail_shcherbakov@center.rt.ru' => 2,
            'Andrey_Pozdnyakov@center.rt.ru' => 2,
            'Pavel_Gordeev@center.rt.ru' => 2,
            'Andrey_Shvoev@center.rt.ru' => 2,
            'Alexey_Kiselev@center.rt.ru' => 2,
            'Andrey_Pautov@center.rt.ru' => 2,
            'vladimir_m_nadraliev@center.rt.ru' => 2,
            'oleg_g_naumov@center.rt.ru' => 2,
            'vladimir_yu_popelnuschenko@center.rt.ru' => 2,
            'aleksandr.sudeykin@rt.ru' => 2,
            'Anton_Pekanov@center.rt.ru' => 2,
            'Aleksey.Gorkovenko@RT.RU' => 2,
            'andrey_kirillov@center.rt.ru' => 2,
            'Natalya.Voronova@RT.RU' => 2,
            'Evgeniya.Akhmetova@RT.RU' => 2,
            'olga.kogoyakova@rt.ru' => 2,
            'E.Y.Ovchinnikova@rt.ru' => 2,
            'Aleksandr.Ustinov@rt.ru' => 2,
            'Pavel.Kobylchenko@rt.ru' => 2,
            'Ayna.Shayukova@RT.RU' => 2,
            'Sergey.Belyaev@RT.RU' => 2,
            'nikolay.biktimirkin@center.rt.ru' => 2,
            'Aleksandr.Minyashkin@RT.RU' => 2,
            'Ilukhin@center.rt.ru' => 2,
            'dmitriy.a.turkov@rt.ru' => 2,
        ];
        $weight = 10;
        foreach ($students as $email => $block_id) {
            $student = new Student();
            $student->created_at = 1601235080;
            $student->created_by = 101;
            $student->user_id = User::findByUsername($email)->id;
            $student->block_id = $block_id;
            $student->total = 0;
            $student->description = 'Участник подключен к обучению 28.09.2020';
            $student->weight = $weight;
            $student->save();
            echo 'Пользователь с почтой ' . $email . ' успешно создан' . PHP_EOL;
            $weight += 10;
        }
        echo 'Пользователи успешно заведены' . PHP_EOL;
    }
}