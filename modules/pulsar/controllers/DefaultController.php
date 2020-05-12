<?php

namespace app\modules\pulsar\controllers;

use app\modules\pulsar\models\Pulsar;
use app\modules\user\models\User;
use foo\bar;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `pulsar` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        // Сотрудники подразделения
        $users = User::find()->where('department_id=1')->all(); // Все сотрудники подразделения

        // Кто ещё не проголосовал
        $userIdsVoted = Pulsar::find()->select('created_by')->where('created_at>=' . strtotime(date('d.m.Y')))->groupBy('created_by')->asArray()->all();
        $userIds = [];
        foreach ($userIdsVoted as $item) {
            $userIds[] = $item['created_by'];
        }
        $whereNotIn = '';
        $usersVoted = []; // Никто ещй не проголосовал
        if (count($userIds)){
            $whereNotIn = " and id NOT IN(" . implode(',', $userIds) . ")";
            $whereIn = " and id IN(" . implode(',', $userIds) . ")";
            $usersVoted = User::find()->where('department_id=1 '.$whereIn)->all();
        }
        $usersNotVoted = User::find()->select('id,fio')->where('department_id=1 '.$whereNotIn)->orderBy('fio')->asArray()->all();

        // Результаты голосования ЗДОРОВЬЕ
        $healthVoted = Pulsar::find()->select('count(*) as health_count,health_value')->where('created_at>=' . strtotime(date('d.m.Y')))->groupBy('health_value')->asArray()->all();
        $healthData=[0,0,0,0,0];
        foreach ($healthVoted as $item) {
            $healthData[$item['health_value']-1]=intval($item['health_count']);
        }
        $healthAverage = round(Pulsar::find()->where('created_at>=' . strtotime(date('d.m.Y')))->average('health_value'),1);

        // Результаты голосования НАСТРОЕНИЕ
        $moodVoted = Pulsar::find()->select('count(*) as mood_count,mood_value')->where('created_at>=' . strtotime(date('d.m.Y')))->groupBy('mood_value')->asArray()->all();
        $moodData=[0,0,0,0,0];
        foreach ($moodVoted as $item) {
            $moodData[$item['mood_value']-1]=intval($item['mood_count']);
        }
        $moodAverage = round(Pulsar::find()->where('created_at>=' . strtotime(date('d.m.Y')))->average('mood_value'),1);


        // Результаты голосования РАБОТА
        $jobVoted = Pulsar::find()->select('count(*) as job_count,job_value')->where('created_at>=' . strtotime(date('d.m.Y')))->groupBy('job_value')->asArray()->all();
        $jobData=[0,0,0,0,0];
        foreach ($jobVoted as $item) {
            $jobData[$item['job_value']-1]=intval($item['job_count']);
        }
        $jobAverage = round(Pulsar::find()->where('created_at>=' . strtotime(date('d.m.Y')))->average('job_value'),1);


        return $this->render('index', [
            'users' => $users,
            'usersVoted' => $usersVoted,
            'usersNotVoted' => $usersNotVoted,

            'healthData' => $healthData,
            'moodData' => $moodData,
            'jobData' => $jobData,

            'healthAverage' => $healthAverage,
            'moodAverage' => $moodAverage,
            'jobAverage' => $jobAverage,
        ]);
    }

    // Результаты ввиде таблицы
    public function actionTable(){

        $userQuery = User::find()->where('user.department_id=1')->orderBy('user.fio')->leftJoin( 'pulsar', 'pulsar.created_by = user.id');

        $userDataProvider = new ActiveDataProvider([
            'query' => $userQuery
        ]);

        return $this->render('table', [
            'userDataProvider'=>$userDataProvider
        ]);
    }
}
