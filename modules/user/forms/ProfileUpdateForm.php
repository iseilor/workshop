<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;
use Yii;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ProfileUpdateForm extends Model
{
    public $email;
    public $birth_date;
    public $gender;

    public $fio;
    public $photo;

    public $position;
    public $department;
    public $phone_work;
    //public $work_date;
    public $experience;

    public $passport_seria;
    public $passport_number;
    public $passport_date;
    public $passport_scan1;
    public $passport_scan2;

    public $snils_number;
    public $snils_scan;

    /**
     * @var User
     */
    private $_user;

    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;

        $this->email = $user->email;
        $this->birth_date = $user->birth_date;

        // Стаж
        //$this->work_date = $user->work_date;
        $this->experience = $user->getExperience();

        $this->gender = $user->gender;
        $this->fio = $user->fio;

        $this->position = $user->position;
        $this->department = $user->department;
        $this->phone_work = $user->phone_work;

        $this->passport_seria = $user->passport_seria;
        $this->passport_number = $user->passport_number;
        $this->passport_date = $user->passport_date;
        $this->passport_scan1 = $user->passport_scan1;
        $this->passport_scan2 = $user->passport_scan2;

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['gender','birth_date','experience'], 'required'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS'),
                'filter' => ['<>', 'id', $this->_user->id],
            ],
            ['email', 'string', 'max' => 255],

            [['birth_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'birth_date'],
            /*[['work_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'work_date'],*/
            ['experience', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'integer'],
            ['experience', 'compare', 'compareValue' => 50, 'operator' => '<=', 'type' => 'integer'],

            [['photo'], 'safe'],
            [['photo'], 'file', 'extensions'=>'jpg, png'],
            [['photo'], 'file', 'maxSize'=>'2048000'],
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;

            $user->email = $this->email;
            $user->birth_date = $this->birth_date;

            // Стаж
            //$user->work_date = $this->work_date;
            $user->work_date =  mktime() - $this->experience* 31556926;

            $user->gender = $this->gender;
            $user->fio = $this->fio;

            $user->position = $this->position;
            $user->department = $this->department;
            $user->phone_work = $this->phone_work;

            $user->passport_seria = $this->passport_seria;
            $user->passport_number = $this->passport_number;
            $user->passport_date = $this->passport_date;
            $user->passport_scan1 = $this->passport_scan1;
            $user->passport_scan2 = $this->passport_scan2;

            $this->photo = UploadedFile::getInstance($this, 'photo');
            if ($this->photo){
                $this->upload();
                $user->photo =   $this->_user->id . '.' . $this->photo->extension;
            }

            return $user->save();
        } else {
            return false;
        }
    }

    // Загрузка файлов
    public function upload()
    {

        if ($this->validate()) {
            $this->photo->saveAs(Yii::$app->params['module']['user']['photoPath'].$this->_user->id . '.' . $this->photo->extension);
            //$this->photo->saveAs(Yii::$app->params['module']['jk']['doc']['filePath'].$this->id . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }


    public function attributeLabels()
    {
        return User::attributeLabels();
    }

    // Описание поля + картинка
    public function attributeDescription()
    {
        return [
            'experience' => 'Необходимо указать кол-во полных лет вашего общего стажа<br/>
                            с учётом переводов из других подразделение и филиалов<br/>
                            Если ваш стаж менее 1 года, то необходимо указать 0'
        ];
    }
}
