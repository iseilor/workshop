<?php

namespace app\modules\user\models;

use app\models\Model;
use app\modules\user\Module;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user_spouse".
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
 * @property string|null $passport_series
 * @property string|null $passport_number
 * @property int|null    $passport_date
 * @property string|null $passport_department
 * @property string|null $passport_code
 * @property string|null $passport_registration
 * @property string|null $address_fact
 * @property string|null $passport_file
 *
 * @property string|null $personal_data_file
 * @property string|null $edj
 * @property string|null $edj_file
 * @property int|null    $is_work
 * @property int|null    $is_rtk
 * @property int|null    $is_do
 * @property string|null $marriage_file
 * @property string|null $registration_file
 * @property string|null $explanatory_note_file
 * @property string|null $work_file
 * @property string|null $unemployment_file
 * @property string|null $salary_file
 */
class Spouse extends Model
{

    public $marriage_file_form;

    public $passport_file_form;

    public $registration_file_form;

    public $edj_file_form;

    public $explanatory_note_file_form;

    public $work_file_form;

    public $unemployment_file_form;

    public $salary_file_form;

    public $personal_data_file_form;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_spouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'gender', 'is_work', 'is_rtk', 'is_do'], 'integer'],
            [
                [
                    'fio',
                    'passport_series',
                    'passport_number',
                    'passport_department',
                    'passport_code',
                    'passport_registration',
                    'address_fact',
                    'explanatory_note_file',
                    'work_file',
                    'unemployment_file',
                    'salary_file',
                    'marriage_file'
                ],
                'string',
                'max' => 255,
            ],
            [['date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date'],
            [['passport_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'passport_date'],

            [['fio'], 'match', 'pattern' => '/^[а-яА-Я ]+$/u', 'message' => 'Неверный формат ФИО'],

            // Обязательные при наличии супруге
            [
                ['fio','gender','date'],
                'required',
                'when' => function ($model) {
                    return $model->type == 1;
                },
                'whenClient' => "function (attribute, value) {
                    return $('#spouse-type').val() == 1;
                }",
            ],

            // Файлы
            [
                [
                    'marriage_file_form',
                    'passport_file_form',
                    'registration_file_form',
                    'edj_file_form',
                    'explanatory_note_file_form',
                    'work_file_form',
                    'unemployment_file_form',
                    'salary_file_form',
                    'personal_data_file_form',
                ],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'pdf',
                'maxSize' => '5000000',
            ],
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
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),

            // Общие параметры
            'type' => Module::t('spouse', 'Type'),
            'user_id' => Module::t('spouse', 'User ID'),
            'fio' => Module::t('spouse', 'Fio'),
            'gender' => Module::t('spouse', 'Gender'),
            'date' => Module::t('spouse', 'Date'),
            'marriage_file' => Module::t('spouse', 'Marriage File'),
            'marriage_file_form' => Module::t('spouse', 'Marriage File'),

            // Адрес
            'registration_file' => Module::t('spouse', 'Registration'),
            'edj_file' => Module::t('spouse', 'Edj'),
            'registration_file_form' => Module::t('spouse', 'Registration'),
            'edj_file_form' => Module::t('spouse', 'Edj'),

            // Пасспорт
            'passport_series' => Module::t('spouse', 'Passport Series'),
            'passport_number' => Module::t('spouse', 'Passport Number'),
            'passport_date' => Module::t('spouse', 'Passport Date'),
            'passport_department' => Module::t('spouse', 'Passport Department'),
            'passport_code' => Module::t('spouse', 'Passport Code'),
            'passport_registration' => Module::t('spouse', 'Passport Registration'),
            'address_fact' => Module::t('spouse', 'Address Fact'),
            'passport_file' => Module::t('spouse', 'Passport File'),
            'passport_file_form' => Module::t('spouse', 'Passport File'),


            // Трудойстрйство
            'is_work' => Module::t('spouse', 'Is Work'),
            'is_rtk' => Module::t('spouse', 'Is Rtk'),
            'is_do' => Module::t('spouse', 'Is Do'),

            'explanatory_note_file' => Module::t('spouse', 'Explanatory Note File'),
            'work_file' => Module::t('spouse', 'Work File'),
            'unemployment_file' => Module::t('spouse', 'Unemployment File'),
            'salary_file' => Module::t('spouse', 'Salary File'),
            'explanatory_note_file_form' => Module::t('spouse', 'Explanatory Note File'),
            'work_file_form' => Module::t('spouse', 'Work File'),
            'unemployment_file_form' => Module::t('spouse', 'Unemployment File'),
            'salary_file_form' => Module::t('spouse', 'Salary File'),

            // Персонаьные данные
            'personal_data_file_form' => Module::t('spouse', 'Personal Data'),
            'personal_data_file' => Module::t('spouse', 'Personal Data'),

        ];
    }

    public function attributeHints()
    {
        return [
            'fio'=>'Пример: Иванова Анастасия Ивановна',
            'passport_registration' => 'Пример: 123456, г.Москва, ул.Ленина, д.1, кв.1',
            'address_fact' => 'Пример: 123456, г.Москва, ул.Ленина, д.1, кв.1',

        ];
    }

    /**
     * {@inheritdoc}
     * @return SpouseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpouseQuery(get_called_class());
    }

    // Сотрудник, к которому привязываем супруг(а)
    public function behaviors()
    {
        $parent_behaviors = parent::behaviors();
        $parent_behaviors['BlameableBehavior']['attributes'][ActiveRecord::EVENT_BEFORE_INSERT][] = 'user_id';
        return $parent_behaviors;
    }

    // Пол
    public static function getGenderList()
    {
        return [
            1 => 'Мужской',
            0 => 'Женский',
        ];
    }

    // Наличие супруги
    public static function getTypeList()
    {
        return [
            0 => 'Нет',
            1 => 'Да',
            2 => 'Разведён',
        ];
    }

    // Загрузка файлов
    public function upload()
    {
        // Создаём директорию для хранения файлов
        $pathDir = Yii::$app->params['module']['spouse']['filePath'] . $this->id;
        FileHelper::createDirectory($pathDir, $mode = 0777, $recursive = true);

        // Все поля с файлами
        $fields = [
            'marriage_file',

            'passport_file',
            'registration_file',
            'edj_file',

            'explanatory_note_file',
            'work_file',
            'unemployment_file',
            'salary_file',

            'personal_data_file',
        ];

        // Сохраняем данные
        foreach ($fields as $field) {
            $file = UploadedFile::getInstance($this, $field . '_form');
            if ($file) {
                $fileName = 'spouse_' . $this->id . '_' . $field . '_' . date('YmdHis') . '.' . $file->extension;
                $file->saveAs($pathDir . '/' . $fileName);
                $this->{$field} = $fileName;
            }
        }
        return $this->save();
    }
}
