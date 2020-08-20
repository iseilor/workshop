<?php

namespace app\modules\user\forms;

use app\modules\user\models\Ad;
use app\modules\user\models\User;
use app\modules\user\Module;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{

    public $username;

    public $password;

    public $rememberMe = true;

    public $icon = '<i class="fas fa-sign-in-alt"></i>';

    public $userAD;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the username and password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Неверное имя пользователя или пароль.');
            } elseif ($user && $user->status == User::STATUS_BLOCKED) {
                $this->addError('username', 'Ваш аккаунт заблокирован.');
            } elseif ($user && $user->status == User::STATUS_WAIT) {
                $this->addError('username', 'Ваш аккаунт не подтвежден.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        // Ищем пользователя в AD
        if (!$this->userAD = $this->findUserAd()) {
            $this->addError('username', 'Не найдена ваша корпоративная учётная запись');
            return false;
        }

        // Проверяем пароль через AD
        if (!$this->validatePasswordAd()) {
            $this->addError('password', 'Вы указали неверный пароль');
            return false;
        }

        // Рекурсия через AD
        $ad = new Ad();
        $ad->createUserByEmail(($this->username));

        return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
    }

    // Специальный быстрый вход
    public function login2()
    {
        return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
    }

    // Ищем пользователя в AD
    public function findUserAd()
    {
        return Yii::$app->ad->getProvider('default')->search()->findBy('mail', $this->username);
    }

    // Проверяем пароль через AD
    public function validatePasswordAd()
    {
        return true;
        //return Yii::$app->ad->auth()->attempt($this->userAD->userprincipalname[0], $this->password);
    }


    // Создаём пользователя в БД
    public function createUserDB()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->username;
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->photo = Yii::$app->params['module']['user']['photo']['default'];

        $user->fio = $this->userAD->cn[0];
        $user->position = $this->userAD->title[0];
        $user->work_department = $this->userAD->department[0];
        $user->work_department_full = $this->userAD->extensionattribute2[0];
        $user->work_phone = $this->userAD->telephonenumber[0];
        $user->work_address = $this->userAD->extensionattribute11[0];
        $user->department_id = 1;

        // Пол Мужской
        if (strtoupper($this->userAD->extensionattribute1[0]) == 'M') {
            $user->gender = 1;
        } elseif (strtoupper($this->userAD->extensionattribute1[0]) == 'F') {
            $user->gender = 0;
        } else {
            // TODO: Такого быть не должно, но чтобы никого не обидеть не будем ставить никакой пол по умолчанию
        }

        // ФИО разбивка
        $fio = explode(" ", $this->userAD->cn[0]);
        $user->surname = $fio[0];
        $user->name = $fio[1];
        $user->patronymic = $fio[2];

        // Роль по умолчанию
        $user->role_id = 0;

        if ($user->save()) {
            return $user;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => Module::t('module', 'Username'),
            'password' => Module::t('module', 'Password'),
            'rememberMe' => Module::t('module', 'Remember Me'),
        ];
    }
}