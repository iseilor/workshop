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
    public $work_department;
    public $work_department_full;
    public $work_phone;
    public $experience;
    public $work_address;
    public $work_is_young;
    public $work_is_transferred;
    public $user_social_id;

    // PASSPORT
    public $passport_series;
    public $passport_number;
    public $passport_date;
    public $passport_code;
    public $passport_department;
    public $passport_registration;
    public $passport_file;

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


        $this->gender = $user->gender;
        $this->fio = $user->fio;

        // WORK
        $this->experience = $user->getExperience();
        $this->position = $user->position;
        $this->work_department = $user->work_department;
        $this->work_department_full = $user->work_department_full;
        $this->work_phone = $user->work_phone;
        $this->work_address = $user->work_address;
        $this->work_is_young = $user->work_is_young;
        $this->work_is_transferred = $user->work_is_transferred;
        $this->user_social_id = $user->user_social_id;

        // PASSPORT
        $this->passport_series = $user->passport_series;
        $this->passport_number = $user->passport_number;
        $this->passport_date = $user->passport_date;
        $this->passport_code = $user->passport_code;
        $this->passport_department = $user->passport_department;
        $this->passport_registration = $user->passport_registration;
        $this->passport_file = $user->passport_file;

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
            ['experience', 'compare', 'compareValue' => 40, 'operator' => '<=', 'type' => 'integer'],

            [['photo'], 'safe'],
            [['photo'], 'file', 'extensions'=>'jpg, png'],
            [['photo'], 'file', 'maxSize'=>'2048000'],

            [['work_is_young','work_is_transferred','user_social_id'], 'safe'],
            [['passport_series','passport_number','passport_date','passport_code','passport_department','passport_file','passport_registration'], 'safe'],
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

            //$user->position = $this->position;
            //$user->department = $this->department;
            //$user->phone_work = $this->phone_work;
            $user->work_is_young = $this->work_is_young;
            $user->work_is_transferred = $this->work_is_transferred;
            $user->user_social_id = $this->user_social_id;

            $user->passport_series = $this->passport_series;
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
                            Если ваш стаж менее 1 года, то необходимо указать 0',
            'work_is_young'=>'<strong>Молодой работник</strong> - Пользователь в возрасте до 35 лет (включительно),<br/>
                            поступивший в Общество на работу после окончания среднего или высшего образовательного учреждения<br/>
                            по полученной в образовательном учреждении специальности в течение 6 месяцев после окончани<br/>
                            образовательной организации.',
            'work_is_transferred'=>'<strong>Переведенные работники</strong> - Пользователи, переведенные  не ранее чем за 5 лет<br/>
                            до дня принятия ЖК решения об оказании помощи в интересах Общества из одного подразделения<br/>
                            Общества в другое, находящиеся в разных населенных пунктах, расстояние между которыми не менее 50 км.',
        ];
    }
}
