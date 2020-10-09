<?php

namespace app\modules\user\models;

use app\models\Model;
use app\modules\user\Module;
use kartik\icons\Icon;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user_child".
 *
 * @property int         $id
 * @property int         $created_at
 * @property int         $created_by
 * @property int|null    $updated_at
 * @property int|null    $updated_by
 * @property int|null    $deleted_at
 * @property int|null    $deleted_by
 * @property int         $user_id
 * @property string      $fio
 * @property int         $gender
 * @property int         $date
 *
 * @property string      $birth_series
 * @property string      $birth_number
 * @property ing         $birth_date
 * @property string      $birth_department
 * @property string      $birth_code
 * @property string      $birth_file
 *
 *
 * @property string|null $passport_file
 * @property string|null $file_registration
 * @property string|null $address_mother_file_form
 * @property string|null $address_father_file_form
 * @property string|null $file_birth
 * @property string|null $file_address
 * @property string|null $file_ejd
 * @property string|null $file_personal
 *
 * @property string      $address_registration
 * @property string      $address_fact
 *
 * @property int|null    $is_invalid
 * @property string|null $file_invalid
 * @property string|null $file_posobie
 *
 * @property int|null    $is_study
 * @property string|null $file_study
 * @property string|null $file_scholarship
 */
class Child extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_child';
    }

    public $birth_file_form;

    public $passport_file_form;

    public $registration_file_form;

    public $address_mother_file_form;

    public $address_father_file_form;

    public $ejd_file_form;

    public $file_address_form;

    public $file_personal_form;

    public $file_invalid_form;

    public $file_posobie_form;

    public $file_study_form;

    public $file_scholarship_form;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = [
            [['fio', 'date', 'address_registration'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'is_invalid', 'is_study'], 'integer'],
            [['fio'], 'string', 'max' => 255],
            // TODO: с этим не работает в FireFox
            //['fio', 'match', 'pattern' => '~^(\p{L}|\p{Zs})+$~u'],
            [['date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date'],

            // Паспорт
            [['passport_series', 'passport_number', 'passport_date', 'passport_department', 'passport_code', 'passport_address'], 'safe'],
            [
                'date',
                function () {
                    if ($this->date > 0 && time() - $this->date > 14 * 356 * 24 * 60 * 60) {
                        $passport_attrs = ['passport_series', 'passport_number', 'passport_date', 'passport_department', 'passport_code'];
                        foreach ($passport_attrs as $passport_attr) {
                            if ($this->{$passport_attr} == '') {
                                $this->addError($passport_attr, "Данное поле обязательно для заполнения для детей старше 14 лет");
                            }
                        }
                    }
                },
            ],
            [['passport_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'passport_date'],

            // Св-во о рождении
            [['birth_series', 'birth_number', 'birth_date', 'birth_department'/*, 'birth_code'*/], 'required'],
            [['birth_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'birth_date'],
            [
                ['birth_date', 'date'],
                function () {
                    if ($this->birth_date && $this->date && $this->birth_date < $this->date) {
                        $this->addError('birth_date', "Дата не может быть раньше даты рождения");
                    }
                },
            ],

            // Файлы
            [
                [
                    'passport_file_form',
                    'birth_file_form',

                    'file_invalid_form',
                    'file_posobie_form',
                    'file_study_form',
                    'file_scholarship_form',

                    'registration_file_form',
                    'address_mother_file_form',
                    'address_father_file_form',
                    'ejd_file_form',
                    'file_personal_form',

                ],
                'file',
                'skipOnEmpty' => true,
                //'extensions' => 'pdf',
                //'maxSize' => '10000000',
                'maxSize' => '62914560',
            ],
        ];

        if (!$this->file_personal) {
            $rules[] = [['file_personal_form'], 'required','skipOnEmpty' => true,];
        }

        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

            // Модель
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),

            // Общие параметры ребёнка
            'user_id' => Module::t('child', 'User ID'),
            'fio' => Module::t('child', 'Fio'),
            'gender' => Module::t('child', 'Gender'),
            'date' => Module::t('child', 'Date'),
            'age' => Module::t('child', 'Age'),

            // Паспорт
            'passport_series' => Module::t('child', 'Passport Series'),
            'passport_number' => Module::t('child', 'Passport Number'),
            'passport_date' => Module::t('child', 'Passport Date'),
            'passport_department' => Module::t('child', 'Passport Department'),
            'passport_code' => Module::t('child', 'Passport Code'),
            'passport_address' => Module::t('child', 'Passport Address'),
            'passport_file' => Module::t('child', 'Passport File'),
            'passport_file_form' => Module::t('child', 'Passport File'),
            'passportLink' => Module::t('child', 'Passport File'),

            // Св-во о рождении
            'birth_series' => Module::t('child', 'Birth Series'),
            'birth_number' => Module::t('child', 'Birth Number'),
            'birth_date' => Module::t('child', 'Birth Date'),
            'birth_department' => Module::t('child', 'Birth Department'),
            'birth_code' => Module::t('child', 'Birth Code'),
            'birth_file' => Module::t('child', 'Birth File'),
            'birth_file_form' => Module::t('child', 'Birth File'),

            // Адрес
            'address_registration' => Module::t('child', 'Address Registration'),
            'address_fact' => Module::t('child', 'Address Fact'),
            'registration_file' => Module::t('child', 'Registration File'),
            'registration_file_form' => Module::t('child', 'Registration File'),
            'address_mother_file' => Module::t('child', 'Address Mother'),
            'address_father_file' => Module::t('child', 'Address Father'),
            'address_mother_file_form' => Module::t('child', 'Address Mother'),
            'address_father_file_form' => Module::t('child', 'Address Father'),
            'ejd_file' => Module::t('child', 'Ejd'),
            'ejd_file_form' => Module::t('child', 'Ejd_file'),

            'file_address' => Module::t('child', 'File Address'),

            'file_personal' => Module::t('child', 'File Personal'),
            'file_registration_form' => Module::t('child', 'File Registration'),
            'file_birth_form' => Module::t('child', 'File Birth'),
            'birthLink' => Module::t('child', 'File Birth'),
            'file_address_form' => Module::t('child', 'File Address'),

            // Инвалид
            'is_invalid' => Module::t('child', 'Is Invalid'),
            'file_invalid' => Module::t('child', 'File Invalid'),
            'file_posobie' => Module::t('child', 'File Posobie'),
            'file_invalid_form' => Module::t('child', 'File Invalid form'),
            'file_posobie_form' => Module::t('child', 'File Posobie'),

            // Школьник/студент
            'is_study' => Module::t('child', 'Is Study'),
            'file_study' => Module::t('child', 'File Study'),
            'file_scholarship' => Module::t('child', 'File Scholarship'),
            'file_study_form' => Module::t('child', 'File Study'),
            'file_scholarship_form' => Module::t('child', 'File Scholarship'),

            // Обработка персональных данных
            'personalLink' => Module::t('child', 'File PD'),
            'file_personal_form' => Module::t('child', 'File Personal'),
        ];
    }

    public function attributeHints()
    {
        return [
            'passport_series' => '<strong>Пример:</strong> 7788',
            'passport_number' => '<strong>Пример:</strong> 123456',
            'passport_code' => '<strong>Пример:</strong> 778-887',
            'is_study' => 'Дети в возрасте до 23 лет, обучающиеся в образовательном учреждении по очной форме обучения',
            'is_invalid' => 'Дети старше 18 лет, ставшие инвалидами до достижения ими возраста 18 лет',
            'address_registration' => 'Пример: Московская обл., г.Москва, п.Московский, Киевское ш. 22км., д. 6, стр. 1, кв. 5',
            'address_fact' => 'Пример: 123456, г.Москва, ул.Ленина, д.1, кв.1',
            'ejd_file_form' => 'ЕЖД действителен в течение 1 месяца со дня выдачи. Если в населенном пункте не выдается ЕЖД, могут быть предоставлены выписки из домовой книги и справки о составе семьи)',
            'file_personal_form' => 'Скачайте автоматически сформированный '.Html::a(Icon::show('file-pdf') .'бланк', Url::to(['/user/child/' . $this->id . '/pd'])).', который нужно будет распечатать, подписать и прикрепить в поле',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ChildQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChildQuery(get_called_class());
    }

    // Сотрудник, к которому привязываем ребёнка
    public function behaviors()
    {
        $parent_behaviors = parent::behaviors();
        $parent_behaviors['BlameableBehavior']['attributes'][ActiveRecord::EVENT_BEFORE_INSERT][] = 'user_id';
        return $parent_behaviors;
    }



    // Пол ребёнка
    public static function getGenderList()
    {
        return [
            1 => 'Мужской',
            0 => 'Женский',
        ];
    }

    public function beforeValidate()
    {
        if (isset($_FILES["Child"]["name"]["birth_file_form"]) && $_FILES["Child"]["name"]["birth_file_form"]){
            $this->birth_file_form=$_FILES["Child"]["name"]["birth_file_form"];
        }
        if (isset($_FILES["Child"]["name"]["passport_file_form"]) && $_FILES["Child"]["name"]["passport_file_form"]){
            $this->passport_file_form=$_FILES["Child"]["name"]["passport_file_form"];
        }
        return parent::beforeValidate();

    }

    // Загрузка файлов
    public function upload()
    {
        // Создаём директорию для хранения файлов
        $pathDir = Yii::$app->params['module']['child']['filePath'] . $this->id;
        FileHelper::createDirectory($pathDir, $mode = 0777, $recursive = true);

        // Все поля с файлами
        $fields = [
            'passport_file',
            'file_study',
            'file_scholarship',
            'file_invalid',
            'file_posobie',
            'birth_file',
            'registration_file',
            'address_mother_file',
            'address_father_file',
            'ejd_file',
            'file_personal',
        ];

        // Сохраняем данные
        foreach ($fields as $field) {
            $file = UploadedFile::getInstance($this, $field . '_form');
            if ($file) {
                $fileName = 'child_' . $this->id . '_' . $field . '_' . date('YmdHis') . '.' . $file->extension;
                $file->saveAs($pathDir . '/' . $fileName);
                $this->{$field} = $fileName;

                // Это нужно для валидации полей загрузки файлов
                $field_form = $field.'_form';
                $this->{$field_form} = $fileName;
            }
        }
        return $this->save();
    }

    // Возраст ребёнка
    public function getAge()
    {
        return intdiv(time() - $this->date, 31556926);
    }

    // Короткая ссылка с иконкой на паспорт
    public function getPassportLink()
    {
        if ($this->passport_file) {
            return Html::a(Icon::show('file-pdf') . 'Паспорт',
                Url::to('/' . Yii::$app->params['module']['child']['filePath'] . $this->id . '/' . $this->passport_file, true),
                ['title' => 'Паспорт ' . $this->fio, 'data-pjax' => "0", 'target1' => '_blank']);
        } else {
            return false;
        }
    }

    // Короткая ссылка с иконкой на свидетельство
    public function getBirthLink()
    {
        if ($this->birth_file) {
            return Html::a(Icon::show('file-pdf') . 'Свидетельство', Url::to('/' . Yii::$app->params['module']['child']['filePath'] . $this->id . '/' . $this->birth_file, true),
                ['title' => 'Свидетельство о рождении ' . $this->fio, 'target' => '_blank', 'data-pjax' => "0"]);
        } else {
            return false;
        }
    }

    // Ссылка на согласие обработки персональных данных
    public function getPersonalLink()
    {
        if ($this->file_personal) {
            return Html::a(Icon::show('file-pdf') . 'Согласие', Url::to('/' . Yii::$app->params['module']['child']['filePath'] . $this->id . '/' . $this->file_personal, true),
                ['title' => 'Согласие на обработку персональных данных ' . $this->fio, 'target' => '_blank', 'data-pjax' => "0"]);
        } else {
            return false;
        }
    }
}