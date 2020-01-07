<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;
use Yii;

class ProfileUpdateForm extends Model
{
    public $email;
    public $birth_date;
    public $work_date;
    public $gender;
public $experience;

    /**
     * @var User
     */
    private $_user;

    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        $this->email = $user->email;
        $this->birth_date = $user->birth_date;
        $this->work_date = $user->work_date;
        $this->gender = $user->gender;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS'),
                'filter' => ['<>', 'id', $this->_user->id],
            ],
            ['email', 'string', 'max' => 255],
            [['birth_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'birth_date'],
            [['work_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'work_date'],
            ['birth_date','required'],
            ['work_date','required'],
            ['gender','required']
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->email = $this->email;
            $user->birth_date=$this->birth_date;
            $user->work_date=$this->work_date;
            $user->gender=$this->gender;
            return $user->save();
        } else {
            return false;
        }
    }

    public function attributeLabels()
    {
        return User::attributeLabels();
    }
}
