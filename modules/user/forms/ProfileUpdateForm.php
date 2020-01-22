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
    public $work_date;
    public $gender;
    public $experience;
    public $fio;
    public $img;

    public $position;
    public $department;
    public $phone_work;

    public $passport_seria;
    public $passport_number;
    public $passport_date;
    public $passport_scan1;
    public $passport_scan2;

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
            [['email', 'fio','position','department','phone_work','passport_seria','passport_number','passport_date','passport_scan1','passport_scan2'], 'required'],
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
            ['birth_date', 'required'],
            ['work_date', 'required'],
            ['gender', 'required'],

            [['img'], 'safe'],
            [['img'], 'file', 'extensions'=>'jpg, png'],
            [['img'], 'file', 'maxSize'=>'2048000'],
            //[['image_src_filename', 'image_web_filename'], 'string', 'max' => 255],
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;

            $user->email = $this->email;
            $user->birth_date = $this->birth_date;
            $user->work_date = $this->work_date;
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

            //$this->img = UploadedFile::getInstance($this, 'img');
            //$this->upload();
            //$user->img =   $this->_user->id . '.' . $this->img->extension;

            return $user->save();
        } else {
            return false;
        }
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName =  $this->_user->id . '.' . $this->img->extension;
            $fileName100 = $this->_user->id . '_100.' . $this->img->extension;
            $filePath = '@files/user/profile/' ;

            $this->img->saveAs($filePath.$fileName);


            //$image = Yii::getAlias('@webroot/images/img.jpg');

            // Обрежет по высоте на 120px, по ширине на 120px
            /*Image::thumbnail($filePath.$fileName, 100, 100)
                ->save($filePath.$fileName100, ['quality' => 100]);*/
            return true;
        } else {
            return false;
        }
    }

    public function attributeLabels()
    {
        return User::attributeLabels();
    }
}
