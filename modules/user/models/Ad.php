<?php


namespace app\modules\user\models;


use Yii;

class Ad
{

    public $provider;

    public function __construct()
    {
        $this->provider = Yii::$app->ad->getProvider('default');
    }

    // Поиск пользователя по Email
    public function findUserByEmail($email)
    {
        return $this->provider->search()->findBy('mail', $email);
    }

    // Создать пользователия по Email
    public function createUserByEmail($email)
    {
        // Если уже нашли пользователя в БД
        if ($user = User::findByUsername($email)){
            $this->createManager($email);
            return $user;
        }else{
            // Если не нашли пользователя в БД
            $user = new User();
            $userAD = $this->findUserByEmail($email);

            $user->username = mb_strtolower($email);
            $user->email = mb_strtolower($email);
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword(123456);
            $user->photo = Yii::$app->params['module']['user']['photo']['default'];

            $user->fio = $userAD->cn[0];
            $user->position = $userAD->title[0];
            $user->work_department = $userAD->department[0];
            $user->work_department_full = $userAD->extensionattribute2[0];
            $user->work_phone = $userAD->telephonenumber[0];
            $user->work_address = $userAD->extensionattribute11[0];
            $user->department_id = 1;
            $user->role_id = 0;

            if ($user->save()) {
                $this->createManager($email);
                return $user;
            }
        }
    }


    // Поиск по руководителю
    public function searchFindByDn(string $value)
    {
        return $this->provider->search()->findByDn($value);
    }

    // Создаём руководителя для пользователя
    public function createManager($email)
    {
        $user = $this->findUserByEmail($email);
        $manager = $user->getManager();
        if ($manager) {
            $manager = $this->searchFindByDn($manager);
            if ($manager) {
                $manager = $this->createUserByEmail($manager->getEmail());
                $user = User::findByUsername($email);
                if (!isset($user->manager_id)){
                    $user->manager_id = $manager->id;
                    $user->save();
                }
            }
        }
    }

}