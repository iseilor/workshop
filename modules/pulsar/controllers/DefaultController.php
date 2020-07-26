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
        $department_id = 2;// В качестве примера подразделение Воронина

        // Сотрудники подразделения
        $users = User::find()->where('department_id=' . $department_id)->all(); // Все сотрудники подразделения

        // Кто ещё не проголосовал
        $userIdsVoted = Pulsar::find()->select('created_by')->where('created_at>=' . strtotime(date('d.m.Y')))->groupBy('created_by')->asArray()->all();
        $userIds = [];
        foreach ($userIdsVoted as $item) {
            $userIds[] = $item['created_by'];
        }
        $whereNotIn = '';
        $usersVoted = []; // Никто ещё не проголосовал
        if (count($userIds)) {
            $whereNotIn = " and id NOT IN(" . implode(',', $userIds) . ")";
            $whereIn = " and id IN(" . implode(',', $userIds) . ")";
            $usersVoted = User::find()->where('department_id=' . $department_id . ' ' . $whereIn)->all();
        }
        $usersNotVoted = User::find()->select('id,fio')->where('department_id=' . $department_id . ' ' . $whereNotIn)->orderBy('fio')->asArray()->all();

        return $this->render('index', [
            'users' => $users,
            'usersVoted' => $usersVoted,
            'usersNotVoted' => $usersNotVoted,
        ]);
    }

    // Результаты ввиде таблицы
    public function actionTable()
    {

        $userQuery = User::find()->where('user.department_id=2')
            ->orderBy('user.fio')
            ->leftJoin('pulsar', 'pulsar.created_by = user.id');

        $userDataProvider = new ActiveDataProvider([
            'query' => $userQuery,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $this->render('table', [
            'userDataProvider' => $userDataProvider,
        ]);
    }
}
