<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;
use Yii;
use yii\helpers\FileHelper;
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

    // SNILS
    public $snils_number;
    public $snils_date;
    public $snils_file;

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
        $this->photo = Yii::$app->homeUrl.Yii::$app->params['module']['user']['photo']['path'] . $user->photo;

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

        // SNILS
        $this->snils_number = $user->snils_number;
        $this->snils_date = $user->snils_date;
        $this->snils_file = $user->snils_file;

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
            [['passport_file'], 'file', 'extensions'=>'pdf'],
            [['passport_file'], 'file', 'maxSize'=>'10240000'],

            [['snils_number','snils_date','snils_file'], 'safe'],
            [['snils_file'], 'file', 'extensions'=>'pdf'],
            [['snils_file'], 'file', 'maxSize'=>'2048000'],
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;

            // GENERAL
            $user->gender = $this->gender;
            $user->fio = $this->fio;
            $user->email = $this->email;
            $user->birth_date = $this->birth_date;

            // WORK
            $user->work_date =  mktime() - $this->experience* 31556926; // Стаж
            $user->work_is_young = $this->work_is_young;
            $user->work_is_transferred = $this->work_is_transferred;
            $user->user_social_id = $this->user_social_id;

            // PASSPORT
            $user->passport_series = $this->passport_series;
            $user->passport_number = $this->passport_number;
            $user->passport_date = $this->passport_date;
            $user->passport_code = $this->passport_code;
            $user->passport_department = $this->passport_department;
            $user->passport_registration = $this->passport_registration;

            // SNILS
            $user->snils_number = $this->snils_number;
            $user->snils_date = $this->snils_date;

            // Загрузка файлов
            $this->upload();

            return $user->save();
        } else {
            return false;
        }
    }

    // Загрузка файлов
    public function upload()
    {

        if ($this->validate()) {

            // Photo
            $this->photo = UploadedFile::getInstance($this, 'photo');
            if ($this->photo){
                $photoFileDir = Yii::$app->params['module']['user']['photo']['path'];
                $date = date('YmdHis');
                $photoFileName = 'photo_'.$this->_user->id .'_thumb_'.$date. '.' . $this->photo->extension;
                $photoFileOrigName = 'photo_'.$this->_user->id .'_orig_'.$date. '.' . $this->photo->extension;
                FileHelper::createDirectory( $photoFileDir, $mode = 0777, $recursive = true);
                $this->photo->saveAs($photoFileDir. '/'.$photoFileOrigName);
                Image::thumbnail($photoFileDir.$photoFileOrigName, 250, 250)
                    ->save(Yii::getAlias($photoFileDir. $photoFileName), ['quality' => 100]);
                $this->_user->photo = $photoFileName;
            }

            // Passport
            $this->passport_file = UploadedFile::getInstance($this, 'passport_file');
            if ($this->passport_file){
                $passportFileDir = Yii::$app->params['module']['user']['passport']['path'];
                $passportFileName = 'passport_'.$this->_user->id .'_'.date('YmdHis'). '.' . $this->passport_file->extension;
                FileHelper::createDirectory( $passportFileDir, $mode = 0777, $recursive = true);
                $this->passport_file->saveAs($passportFileDir. '/'.$passportFileName);
                $this->_user->passport_file = $passportFileName;
            }

            // SNILS
            $this->snils_file = UploadedFile::getInstance($this, 'snils_file');
            if ($this->snils_file){
                $snilsFileDir = Yii::$app->params['module']['user']['snils']['path'];
                $snilsFileName = 'snils_'.$this->_user->id .'_'.date('YmdHis'). '.' . $this->snils_file->extension;
                FileHelper::createDirectory( $snilsFileDir, $mode = 0777, $recursive = true);
                $this->snils_file->saveAs($snilsFileDir. '/'.$snilsFileName);
                $this->_user->snils_file = $snilsFileName;
            }

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
