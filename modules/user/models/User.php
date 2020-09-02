<?php

namespace app\modules\user\models;

use app\modules\admin\models\Retirement;
use app\modules\pulsar\models\Pulsar;
use app\modules\user\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int         $id
 * @property int         $created_at
 * @property int         $updated_at
 *
 * @property string      $username
 * @property string      $surname
 * @property string      $name
 * @property string      $patronymic
 *
 * @property string|null $auth_key
 * @property string|null $email_confirm_token
 * @property string      $password_hash
 * @property string|null $password_reset_token
 * @property string      $email
 * @property int         $status
 *
 * @property int         $birth_date
 * @property int         $gender
 * @property string      $photo
 *
 * WORK
 * @property int         $work_date
 * @property int         $department_id
 *
 * @property boolean     $work_is_young
 * @property boolean     $work_is_transferred
 * @property string      $work_transferred_file
 * @property boolean     $work_department
 * @property boolean     $work_department_full
 * @property string      $rf
 *
 * @property boolean     $work_phone
 * @property string      $work_address
 * @property int         $manager_id
 *
 * PASSPORT -------------------------------------------------------
 * @property Passport    $passport
 * @property int         $passport_series
 * @property int         $passport_number
 * @property int         $passport_date
 * @property string      $passport_code
 * @property string      $passport_department
 * @property string      $passport_registration
 * @property string      $address_fact
 * @property string      $passport_file
 * @property string      $ejd_file
 * @property boolean     $is_temporary_registered
 * @property string      $temporary_registration_file
 *
 *
 * SNILS ----------------------------------------------------------
 * @property string      $snils_number
 * @property int         $snils_date
 * @property string      $snils_file
 * @property int         $filial_id
 *
 * @property Child[]    $children
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    const STATUS_BLOCKED = 0;

    const STATUS_ACTIVE = 1;

    const STATUS_WAIT = 2;

    const SCENARIO_PROFILE = 'profile';

    const ROLE_USER = 0;

    const ROLE_MANAGER = 1;

    const ROLE_ADMIN = 2;

    /**
     * @var mixed|null
     */


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => self::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::class, 'message' => 'This email address has already been taken.'],
            ['email', 'string', 'max' => 255],

            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],

            [['img'], 'safe'],
            [['img'], 'file', 'extensions' => 'jpg, png'],
            [['img'], 'file', 'maxSize' => '100000'],
            //[['image_src_filename', 'image_web_filename'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'username' => Module::t('module', 'Username'),
            'auth_key' => Module::t('module', 'Auth Key'),
            'email_confirm_token' => Module::t('module', 'Email Confirm Token'),
            'password_hash' => Module::t('module', 'Password Hash'),
            'password_reset_token' => Module::t('module', 'Password Reset Token'),
            'email' => Module::t('module', 'Email'),
            'status' => Module::t('module', 'Status'),

            'fio' => Module::t('module', 'FIO'),
            'photo' => Module::t('module', 'Photo'),

            // WORK
            'tab_number' => Module::t('module', 'Tab Number'),
            'position' => Module::t('module', 'Position'),
            'work_department' => Module::t('module', 'Work Department'),
            'work_department_full' => Module::t('module', 'Work Department Full'),
            'work_phone' => Module::t('module', 'Work Phone'),
            'work_address' => Module::t('module', 'Work Address'),
            'work_is_young' => Module::t('module', 'Work Is Young'),
            'work_is_transferred' => Module::t('module', 'Work Is Transferred'),
            'work_transferred_file' => Module::t('module', 'Work Transferred File'),


            'birth_date' => Module::t('module', 'Birth Date'),
            'work_date' => Module::t('module', 'Work Date'),
            'experience' => Module::t('module', 'Experience'),
            'gender' => Module::t('module', 'Gender'),

            // PASSPORT
            'passport_series' => Module::t('module', 'Passport Series'),
            'passport_number' => Module::t('module', 'Passport Number'),
            'passport_date' => Module::t('module', 'Passport Date'),
            'passport_code' => Module::t('module', 'Passport Code'),
            'passport_department' => Module::t('module', 'Passport Department'),
            'passport_registration' => Module::t('module', 'Passport Registration'),
            'address_fact' => Module::t('module', 'Address Fact'),
            'passport_file' => Module::t('module', 'Passport File'),
            'ejd_file' => Module::t('module', 'EJD File'),
            'is_temporary_registered' => Module::t('module', 'Is Temporary Registered'),
            'temporary_registration_file' => Module::t('module', 'Temporary Registration File'),

            // SNILS
            'snils_number' => Module::t('module', 'Snils Number'),
            'snils_date' => Module::t('module', 'Snils Date'),
            'snils_file' => Module::t('module', 'Snils File'),
        ];
    }

    public function attributeHints()
    {
        return [
            'experience' => 'Необходимо указать кол-во полных лет вашего общего стажа с учётом переводов из других подразделение и филиалов. 
                            Если ваш стаж менее 1 года, то необходимо указать 0',
            'work_is_young' => '<strong>Молодой работник</strong> - сотрудник в возрасте до 35 лет (включительно), поступивший в 
                            Общество на работу после окончания среднего или высшего образовательного учреждения по полученной 
                            в образовательном учреждении специальности в течение 6 месяцев после окончания образовательной организации.',
            'work_is_transferred' => '<strong>Переведенные работники</strong> - сотрудники, переведенные  не ранее чем за 5 лет до дня принятия 
                            ЖК решения об оказании помощи в интересах Общества из одного подразделения Общества в другое, находящиеся в 
                            разных населенных пунктах, расстояние между которыми не менее 50 км.',
            'work_transferred_file' => 'PDF, не более 10MB',
            'passport_department' => '<strong>Пример</strong>: МВД Тверского района, г.Москва',
            'passport_registration' => 'Адрес регистрации из паспорта, вида: 123456, г.Москва, ул.Ленина, д.1, кв.1',
            'address_fact' => '<strong>Пример:</strong> 123456 Московская обл., г. Москва, п.Московский, Киевское ш. 22 км., д. 6, стр. 1, кв. 5',
            'ejd_file' => ' Единый жилищный документ (действителен в течение 1 месяца со дня выдачи); 
            (если в населенном пункте не выдается ЕЖД, могут быть предоставлены выписки из домовой книги и справки о составе семьи)',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public function getRoleName()
    {
        return ArrayHelper::getValue(self::getRolesArray(), $this->role_id);
    }

    public function getRf()
    {
        $depList = explode('|', $this->work_department_full);
        if (isset($depList[2])) {
            return trim($depList[2]);
        }
        return "";
    }


    // Проставляем филиал уже загруженным пользователям
    public static function setFilialId()
    {
        $users = \app\modules\user\models\User::find()->all();
        $rfs = \app\modules\jk\models\Rf::find()->all();
        $items = ArrayHelper::map($rfs, 'title', 'id');
        foreach ($users as $user) {
            if (isset($items[$user->rf])) {
                $user->filial_id = $items[$user->rf];
            } else {
                $user->filial_id = 0;
            }
            $user->save();
        }
        return true;
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => 'Заблокирован',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_WAIT => 'Ожидает подтверждения',
        ];
    }

    public static function getRolesArray()
    {
        return [
            self::ROLE_USER => 'Пользователь',
            self::ROLE_MANAGER => 'Куратор',
            self::ROLE_ADMIN => 'Админ',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     *
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne(
            [
                'password_reset_token' => $token,
                'status' => self::STATUS_ACTIVE,
            ]
        );
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     *
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int)end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @param string $email_confirm_token
     *
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_WAIT]);
    }

    /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['username', 'email', 'status'],
            self::SCENARIO_PROFILE => ['email'],
        ];
    }

    // Возраст, кол-во полных лет
    public function getYears()
    {
        return intdiv(mktime() - $this->birth_date, 31556926);
    }

    // Получить стаж, кол-во полных лет
    public function getExperience()
    {
        if ($this->work_date) {
            return intdiv(mktime() - $this->work_date, 31556926);
        } else {
            return false;
        }
    }


    // Дата выхода на пенсию
    public function getPensionDate()
    {
        $pensionMale = Retirement::findOne(1);
        $pensionFemale = Retirement::findOne(2);

        $date = '';
        if ($this->gender == 1) {
            $date = date('d.m.Y', $this->birth_date + $pensionMale->age * 31556926);
        }
        if ($this->gender === 0) {
            $date = date('d.m.Y', $this->birth_date + $pensionFemale->age * 31556926);
        }
        return $date;
    }

    // Кол-во полных лет до пенсии
    public function getPensionYears()
    {
        return intdiv(strtotime($this->getPensionDate()) - mktime(), 31556926);
    }

    // Проверяем заполненность профиля, если нет, то просим дозаполнить
    public function getIsJKAccess()
    {
        if (isset($this->gender)
            && isset($this->birth_date)
            && isset($this->work_date)
        ) {
            return true;
        } else {
            return false;
        }
    }

    // Получаем путь до фотографии пользователя
    public function getPhotoPath()
    {
        $photoPath = Yii::$app->homeUrl . Yii::$app->params['module']['user']['photo']['path'] . Yii::$app->params['module']['user']['photo']['default'];
        if (isset($this->photo) && $this->photo) {
            $photoPath = Yii::$app->homeUrl . Yii::$app->params['module']['user']['photo']['path'] . $this->photo;
        }
        return $photoPath;
    }


    /*
    //
    public function getAvatar(){
        if(isset($this->photo)){
$userPhoto = Yii::$app->user->identity->photo;
$userPhotoPath = Yii::$app->homeUrl.Yii::$app->params['module']['user']['photo']['path'].$userPhoto;
?>
retrun Html::img($userPhotoPath, ['title' => Yii::$app->user->identity->username,'class'=>'img-circle elevation-2']) ?>
}
        }

    }*/


    // Описание про пользователя
    public function getTooltip()
    {
        return Yii::$app->view->renderFile('@app/modules/user/views/default/tooltip.php', ['model' => $this]);
    }

    // Ссылка на пользователя
    public static function getUserLink($id)
    {
        $user = User::findOne($id);
        return Yii::$app->view->renderFile('@app/modules/user/views/default/ling.php', ['model' => $user]);
    }

    // Связь с Пульсаром
    public function getPulsar()
    {
        return $this->hasOne(Pulsar::className(), ['created_by' => 'id'])->where('created_at>=' . strtotime(date('d.m.Y')))->orderBy('created_at DESC');
    }

    public static function getGenderList()
    {
        return [
            '1' => 'Мужской',
            '0' => 'Женский',
        ];
    }

    public static function getGenderName($value)
    {
        if ($value == 0 || $value == 1) {
            return (self::getGenderList()[$value]) ? self::getGenderList()[$value] : 'Неверно указан пол';
        } else {
            return false;
        }

    }

    // Смотрим, заполнен ли паспорт пользователя
    public function isPassport()
    {
        if (isset($this->passport_series) && isset($this->passport_number) && isset($this->passport_date) && isset($this->passport_code)
            && isset($this->passport_department)
            && isset($this->passport_registration)
            && isset($this->passport_file)
        ) {
            return true;
        } else {
            return false;
        }
    }


    // Цеподчка подчинённости
    public function getManagerList()
    {
        $list = [];
        $manager_id = $this->manager_id;
        while (isset($manager_id)) {
            $list[] = $manager_id;
            $manager = User::findOne($manager_id);
            $manager_id = $manager->manager_id;
        }
        return $list;
    }

    public function getPassport()
    {
        $passport = new Passport();

        $passport->passport_series = $this->passport_series;
        $passport->passport_number = $this->passport_number;
        $passport->passport_date = $this->passport_date;
        $passport->passport_code = $this->passport_code;
        $passport->passport_department = $this->passport_department;
        $passport->passport_registration = $this->passport_registration;
        $passport->address_fact = $this->address_fact;
        $passport->passport_file = $this->passport_file;
        $passport->is_temporary_registered = $this->is_temporary_registered;
        $passport->temporary_registration_file = $this->temporary_registration_file;
        $passport->ejd_file = $this->ejd_file;

        return $passport;
    }

    // Получаем инициалы пользователя
    // TODO: Временное решение, будем их получать из AD и хранить в DB
    public function getInitials()
    {
        return mb_substr($this->name, 0, 1) . '.' . mb_substr($this->patronymic, 0, 1) . '.';
    }

    public function getChildren() {
        return Child::find()->where(['user_id' => $this->id])->all();
    }
}
