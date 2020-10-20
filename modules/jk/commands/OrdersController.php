<?php

namespace app\modules\jk\commands;

use app\modules\jk\models\Order;
use yii\console\Controller;

class OrdersController extends Controller
{

    /**
     * Стартовая страница
     */
    public function actionIndex()
    {
        echo 'Команды для модуля ЖК'. PHP_EOL;
    }


    /**
     * Принудительно переводим заявки, которые находятся на согласовании у руководителей
     * в статус "Проверка куратором"
     */
    public function actionCurator()
    {
        echo 'Начало работы скрипта '.date('d.m.Y H:i:s') . PHP_EOL;

        // Ищем заявки, которые находятся на согласовании у руководителей
        $orders = Order::findAll(['status_id' => 2]);
        foreach ($orders as $order) {
            $statusOld = $order->status_id;
            $order->sendCurator();
            echo 'Заявка №'.$order->id .': смена статуса '.$statusOld.'->'.$order->status_id. PHP_EOL;
            break;
        }
        echo 'Выполнение скрипта успешно завершено '.date('d.m.Y H:i:s') . PHP_EOL;
    }
}