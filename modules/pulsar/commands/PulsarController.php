<?php

namespace app\modules\pulsar\commands;

use app\modules\pulsar\models\Pulsar;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;
use yii\console\Controller;
use yii\console\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\Console;

class PulsarController extends Controller
{

    // Отправляем сотрудникам письма, что они ещё сегодня не отметились в пульсаре. Письмо в 12:00
    public function actionUserReminder()
    {

        // Выбираем тех, кто сегодня ещё не проголосовал
        $userIdsVoted = Pulsar::find()->select('created_by')->where('created_at>=' . strtotime(date('d.m.Y')))->groupBy('created_by')->asArray()->all();
        $userIds = [];
        foreach ($userIdsVoted as $item) {
            $userIds[] = $item['created_by'];
        }
        $whereNotIn = '';
        $usersVoted = []; // Никто ещё не проголосовал
        if (count($userIds)){
            $whereNotIn = " and id NOT IN(" . implode(',', $userIds) . ")";
            $whereIn = " and id IN(" . implode(',', $userIds) . ")";
            $usersVoted = User::find()->where('department_id=2 '.$whereIn)->all();
        }
        $usersNotVoted = User::find()->select('id,fio')->where('department_id=2 '.$whereNotIn)->orderBy('fio')->asArray()->all();

        // Всем отравляем сообщения-напоминания
        foreach ($usersNotVoted as $userNotVoted) {
            $user = User::findOne($userNotVoted['id']);
            Yii::$app->mailer->compose(
                '@app/modules/pulsar/mails/userReminder',
                [
                    'user' =>$user
                ]
            )
                ->setFrom('workshop@tr.ru')
                ->setTo('obedkinav@ya.ru')
                ->setSubject('Workshop / Пульсар / Напоминание')
                ->send();
            echo 'Сообщение успешно отправлено '.$user->fio . PHP_EOL;
        }
    }

    // Отчёт руководителю подразделения
    public function actionManagerReport(){

        // Руководитель
        $user = User::findOne(1);

        // Статистика
        $data=[
            'health'=>[
                'today'=>Pulsar::getHealthAverage(date('d.m.Y'),2),
                'yesterday'=>Pulsar::getHealthAverage(date('d.m.Y',time() - 60 * 60 * 24),2),
            ],
            'mood'=>[
                'today'=>Pulsar::getMoodAverage(date('d.m.Y'),2),
                'yesterday'=>Pulsar::getMoodAverage(date('d.m.Y',time() - 60 * 60 * 24),2),
            ],
            'job'=>[
                'today'=>Pulsar::getJobAverage(date('d.m.Y'),2),
                'yesterday'=>Pulsar::getJobAverage(date('d.m.Y',time() - 60 * 60 * 24),2),
            ]
        ];

        // Разница
        $types = ['health','mood','job'];
        foreach ($types as $type) {
            $data[$type]['diff']=$data[$type]['today']-$data[$type]['yesterday'];
            if ($data[$type]['diff']<0){
                $data[$type]['diff'] = '<span style="color:red;">↓'.$data[$type]['diff'].'</span>';
            }
            if ($data[$type]['diff']>0){
                $data[$type]['diff'] = '<span style="color:green;">↑+'.$data[$type]['diff'].'</span>';
            }
        }

        Yii::$app->mailer->compose(
            '@app/modules/pulsar/mails/managerReport',
            [
                'user' =>$user,
                'data'=>$data,
                'usersNotVoted'=>Pulsar::usersNotVoted(2,date('d.m.Y')),
            ]
        )
            ->setFrom('workshop@tr.ru')
            ->setTo('obedkinav@ya.ru')
            ->setSubject('Workshop / Пульсар / Отчёт за '.date('d.m.Y'))
            ->send();
        echo 'Сообщение руководителю успешно отправлено  '. PHP_EOL;
    }
}