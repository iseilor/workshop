<?php

namespace app\modules\user\forms;

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
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        // Заглушка для тестирования вне AD
        if ($this->username != 'obedkinav@ya.ru') {
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

            // Ищем пользователя в DB
            if (!$this->getUser()) {
                $this->createUserDB();
                $this->_user = false;
            };
        }

        return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);

        // Старая авторизация через БД
        /*if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }*/
    }

    // Ищем пользователя в AD
    public function findUserAd()
    {
        return Yii::$app->ad->getProvider('default')->search()->findBy('mail', $this->username);
    }

    // Проверяем пароль через AD
    public function validatePasswordAd()
    {
        return Yii::$app->ad->auth()->attempt($this->userAD->mailnickname[0], $this->password);
    }


    // Создаём пользователя в БД
    public function createUserDB()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->username;
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($this->password);

        $user->fio = $this->userAD->cn[0];
        $user->position = $this->userAD->title[0];
        $user->department = $this->userAD->department[0];

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
            'rememberMe' => Module::t('module', 'Remember Me')
        ];
    }
}