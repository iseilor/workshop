<?php


namespace app\modules\user\models;


use Yii;

class Ad
{

    var $provider;

    function __construct()
    {
        $this->provider = Yii::$app->ad->getProvider('default');
    }

    // Поиск пользователя по Email
    function findUserByEmail($email){
        return $this->provider->search()->findBy('mail', $email);
    }

    // Создать пользователия по Email
    function createUserByEmail($email){
        $user = new User();
        $userAD = findUserByEmail($email);

        $user->username = $email;
        $user->email = $email;
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

        if ($user->save()){

            $this->createManager($email);
            return $user;
        }
    }


    // Поиск по руководителю
    function findByDn(string $value){
        return $this->provider->findByDn($value);
    }

    // Создаём руководителя для пользователя
    function createManager($email){
        $user = $this->findUserByEmail($email);
        $manager = $user->getManager();
        if ($manager){
            $manager = $this->findByDn($manager);
            if ($manager){
                $manager = $this->createUserByEmail($manager->getEmail());

                $user = User::findByUsername($email);
                $user->manager_id = $manager->id;
                $user->save();
            }
        }
    }
}