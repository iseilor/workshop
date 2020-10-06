<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;
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

    public $tab_number;
    public $position;
    public $work_department;
    public $work_department_full;
    public $work_phone;
    public $experience;
    public $work_address;
    public $work_is_young;
    public $work_is_transferred;
    public $work_transferred_file;

    // PASSPORT
    public $passport_series;
    public $passport_number;
    public $passport_date;
    public $passport_code;
    public $passport_department;
    public $passport_registration;
    public $address_fact;
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
        $this->tab_number=$user->tab_number;
        $this->experience = $user->getExperience();
        $this->position = $user->position;
        $this->work_department = $user->work_department;
        $this->work_department_full = $user->work_department_full;
        $this->work_phone = $user->work_phone;
        $this->work_address = $user->work_address;
        $this->work_is_young = $user->work_is_young;
        $this->work_is_transferred = $user->work_is_transferred;
        $this->work_transferred_file = $user->work_transferred_file;

        // PASSPORT
        $this->passport_series = $user->passport_series;
        $this->passport_number = $user->passport_number;
        $this->passport_date = $user->passport_date;
        $this->passport_code = $user->passport_code;
        $this->passport_department = $user->passport_department;
        $this->passport_registration = $user->passport_registration;
        $this->address_fact = $user->address_fact;
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
            [['gender','birth_date','experience'/*,'tab_number'*/], 'required'],
            [
                'email',
                'unique',
                'targetClass' => User::class,
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

            [['work_is_young','work_is_transferred','work_transferred_file', 'tab_number'], 'safe'],
            [['work_transferred_file'], 'file', /*'extensions'=>'pdf'*/],
            [['work_transferred_file'], 'file', 'maxSize'=>'2048000'],

            [['passport_series','passport_number','passport_date','passport_code','passport_department','passport_file','passport_registration','address_fact'], 'safe'],
            [['passport_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'passport_date'],
            [['passport_file'], 'file', /*'extensions'=>'pdf'*/],
            [['passport_file'], 'file', 'maxSize'=>'10240000'],

            [['snils_number','snils_date','snils_file'], 'safe'],
            [['snils_file'], 'file', /*'extensions'=>'pdf'*/],
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
            $user->tab_number=$this->tab_number;
            $user->work_date =  time() - $this->experience* 31556926; // Стаж
            $user->work_is_young = $this->work_is_young;
            $user->work_is_transferred = $this->work_is_transferred;

            // PASSPORT
            $user->passport_series = $this->passport_series;
            $user->passport_number = $this->passport_number;
            $user->passport_date = $this->passport_date;
            $user->passport_code = $this->passport_code;
            $user->passport_department = $this->passport_department;
            $user->passport_registration = $this->passport_registration;
            $user->address_fact = $this->address_fact;

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

            // Transferred file
            $this->work_transferred_file = UploadedFile::getInstance($this, 'work_transferred_file');
            if ($this->work_transferred_file){
                $fileDir = Yii::$app->params['module']['user']['path'].$this->_user->id;
                $fileName = $this->_user->id .' | '.$this->_user->fio.' | Заявление о переводе | '.date('d.m.Y H:i:s'). '.' . $this->work_transferred_file->extension;
                FileHelper::createDirectory( $fileDir, $mode = 0777, $recursive = true);
                $this->work_transferred_file->saveAs($fileDir. '/'.$fileName);
                $this->_user->work_transferred_file = $fileName;
            }

            // Passport
            $passport_file = UploadedFile::getInstance($this, 'passport_file');
            if ($passport_file){
                $passportFileDir = Yii::$app->params['module']['user']['path'].$this->_user->id;
                $passportFileName = $this->_user->id .'_passport_'.date('YmdHis'). '.' . $passport_file->extension;
                FileHelper::createDirectory( $passportFileDir, $mode = 0777, $recursive = true);
                $passport_file->saveAs($passportFileDir. '/'.$passportFileName);
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

    public function attributeHints()
    {
        return User::attributeHints();
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