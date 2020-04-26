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
 * @property string      $birth_address
 * @property string      $birth_file
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
        return [
            [['fio', 'gender', 'date', 'address_registration'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'gender', 'is_invalid', 'is_study'], 'integer'],
            [['fio'], 'string', 'max' => 255],
            ['fio', 'match', 'pattern' => '~^(\p{L}|\p{Zs})+$~u'],
            [['date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date'],

            // Св-во о рождении
            [['birth_series', 'birth_number', 'birth_date', 'birth_department', 'birth_code', 'birth_address'], 'required'],
            [['birth_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'birth_date'],


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
                'extensions' => 'pdf',
                'maxSize' => '1024000',
            ],
        ];
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
            'passport_file' => Module::t('child', 'Passport'),
            'passport_file_form' => Module::t('child', 'Passport'),
            'passportLink' => Module::t('child', 'Passport'),

            // Св-во о рождении
            'birth_series' => Module::t('child', 'Birth Series'),
            'birth_number' => Module::t('child', 'Birth Number'),
            'birth_date' => Module::t('child', 'Birth Date'),
            'birth_department' => Module::t('child', 'Birth Department'),
            'birth_code' => Module::t('child', 'Birth Code'),
            'birth_address' => Module::t('child', 'Birth Address'),
            'birth_file' => Module::t('child', 'Birth File'),
            'birth_file_form' => Module::t('child', 'Birth File'),

            // Адрес
            'address_registration' => Module::t('child', 'Address Registration'),
            'registration_file' => Module::t('child', 'Registration File'),
            'registration_file_form' => Module::t('child', 'Registration File'),
            'address_mother_file' => Module::t('child', 'Address Mother'),
            'address_father_file' => Module::t('child', 'Address Father'),
            'address_mother_file_form' => Module::t('child', 'Address Mother'),
            'address_father_file_form' => Module::t('child', 'Address Father'),
            'ejd_file' => Module::t('child', 'Ejd'),
            'ejd_file_form' => Module::t('child', 'Ejd'),

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
            'file_invalid_form' => Module::t('child', 'File Invalid'),
            'file_posobie_form' => Module::t('child', 'File Posobie'),

            // Школьник/студент
            'is_study' => Module::t('child', 'Is Study'),
            'file_study' => Module::t('child', 'File Study'),
            'file_scholarship' => Module::t('child', 'File Scholarship'),
            'file_study_form' => Module::t('child', 'File Study'),
            'file_scholarship_form' => Module::t('child', 'File Scholarship'),

            // Обработка персональных данных
            'personalDataLink' => Module::t('child', 'File PD'),
            'file_personal_form' => Module::t('child', 'File Personal'),
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
            }
        }
        return $this->save();
    }

    // Возраст ребёнка
    public function getAge()
    {
        return intdiv(mktime() - $this->date, 31556926);
    }

    // Короткая ссылка с иконкой на паспорт
    public function getPassportLink()
    {
        if ($this->passport_file) {
            return Html::a(Icon::show('file-pdf'), Url::to('/' . Yii::$app->params['module']['child']['filePath'] . $this->id . '/' . $this->passport_file),
                ['title' => 'Паспорт ' . $this->fio, 'target' => '_blank']);
        } else {
            return false;
        }
    }

    // Короткая ссылка с иконкой на свидетельство
    public function getBirthLink()
    {
        if ($this->passport_file) {
            return Html::a(Icon::show('file-pdf'), '123', ['Свидетельство о рождении' . $this->fio]);
        } else {
            return false;
        }
    }

    // Ссылка на файл с персональными данными
    public function getPersonalDataLink()
    {
        if ($this->file_personal) {
            return Html::a(Icon::show('file-pdf'), Url::to('/' . Yii::$app->params['module']['child']['filePath'] . $this->id . '/' . $this->file_personal),
                ['title' => 'Согласие на обработку персональных данных по ребёнку ' . $this->fio, 'target' => '_blank']);
        } else {
            return false;
        }
    }

}
