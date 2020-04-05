<?php

namespace app\modules\user\models;

use app\models\Model;
use app\modules\user\Module;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
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
 * @property string|null $file_passport
 * @property string|null $file_registration
 * @property string|null $file_birth
 * @property string|null $file_address
 * @property string|null $file_ejd
 * @property string|null $file_personal
 * @property int|null    $is_invalid
 * @property string|null $file_invalid
 * @property string|null $file_posobie
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

    public $file_passport_form;

    public $file_registration_form;

    public $file_birth_form;

    public $file_address_form;

    public $file_ejd_form;

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
            [['fio', 'gender', 'date'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'gender', 'is_invalid', 'is_study'], 'integer'],
            [['fio'], 'string', 'max' => 255],
            ['fio', 'match','pattern'=>'~^(\p{L}|\p{Zs})+$~u'],
            [['date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date'],
            [
                [
                    'file_passport_form',
                    'file_registration_form',
                    'file_birth_form',
                    'file_address_form',
                    'file_ejd_form',
                    'file_personal_form',
                    'file_invalid_form',
                    'file_posobie_form',
                    'file_study_form',
                    'file_scholarship_form',
                ],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'pdf',
                'maxSize' => '2048',
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

            'user_id' => Module::t('child', 'User ID'),
            'fio' => Module::t('child', 'Fio'),
            'gender' => Module::t('child', 'Gender'),
            'date' => Module::t('child', 'Date'),

            'file_passport' => Module::t('child', 'File Passport'),
            'file_registration' => Module::t('child', 'File Registration'),
            'file_birth' => Module::t('child', 'File Birth'),
            'file_address' => Module::t('child', 'File Address'),
            'file_ejd' => Module::t('child', 'File Ejd'),
            'file_personal' => Module::t('child', 'File Personal'),

            'file_passport_form' => Module::t('child', 'File Passport'),
            'file_registration_form' => Module::t('child', 'File Registration'),
            'file_birth_form' => Module::t('child', 'File Birth'),
            'file_address_form' => Module::t('child', 'File Address'),
            'file_ejd_form' => Module::t('child', 'File Ejd'),
            'file_personal_form' => Module::t('child', 'File Personal'),

            'is_invalid' => Module::t('child', 'Is Invalid'),
            'file_invalid' => Module::t('child', 'File Invalid'),
            'file_posobie' => Module::t('child', 'File Posobie'),
            'file_invalid_form' => Module::t('child', 'File Invalid'),
            'file_posobie_form' => Module::t('child', 'File Posobie'),

            'is_study' => Module::t('child', 'Is Study'),
            'file_study' => Module::t('child', 'File Study'),
            'file_scholarship' => Module::t('child', 'File Scholarship'),
            'file_study_form' => Module::t('child', 'File Study'),
            'file_scholarship_form' => Module::t('child', 'File Scholarship'),
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
            'file_passport_form',
            'file_registration_form',
            'file_birth_form',
            'file_address_form',
            'file_ejd_form',
            'file_personal_form',
            'file_invalid_form',
            'file_posobie_form',
            'file_study_form',
            'file_scholarship_form',
        ];

        // Сохраняем данные
        foreach ($fields as $fieldForm) {
            $file = UploadedFile::getInstance($this, $fieldForm);
            if ($file) {
                $field = str_replace("_form", "", $fieldForm);
                $fileName = 'child_' . $this->id . '_' . $field . '_' . date('YmdHis') . '.' . $file->extension;
                $file->saveAs($pathDir . '/' . $fileName);
                $this->{$field} = $fileName;
            }
        }
        return $this->save();
    }
}
