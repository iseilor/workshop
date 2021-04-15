<?php
/***
 * Команды в консоли:
 * php yii migrate --migrationsPath=@yii/rbac/migrations
 * php yii user/rbac-start/init
 * php yii user/rbac-start/set
 */
namespace app\modules\user\commands;

use Yii;
use yii\console\Controller;

class RbacStartController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // User
        $user = $auth->createRole('user');
        $auth->add($user);

        // Curator RF
        $curatorRF = $auth->createRole('curator_rf');
        $auth->add($curatorRF);
        $auth->addChild($curatorRF, $user);

        // Curator MRF
        $curatorMRF = $auth->createRole('curator_mrf');
        $auth->add($curatorMRF);
        $auth->addChild($curatorMRF, $curatorRF);

        // Admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $curatorMRF);

        echo 'Первичная настрйока RBAC успешно произведена' . PHP_EOL;
    }

    // Первичная настройка ролей
    public function actionSet()
    {


        $auth = Yii::$app->authManager;

        //Админы
        $role = $auth->getRole('admin');
        $admins = [1, 101, 110, 126, 195, 201];
        foreach ($admins as $id) {
            $auth->revokeAll($id);
            $auth->assign($role, $id);
        }

        // Кураторы РФ
        $role = $auth->getRole('curator_rf');
        $curators = [160,163,166,169,172,175,178,181,184,186,187,191];
        foreach ($curators as $id) {
            $auth->revokeAll($id);
            $auth->assign($role, $id);
        }

        // Кураторы МРФ
        $role = $auth->getRole('curator_mrf');
        $curators = [111];
        foreach ($curators as $id) {
            $auth->revokeAll($id);
            $auth->assign($role, $id);
        }

        echo 'Роли успешно проставлены' . PHP_EOL;
    }
}