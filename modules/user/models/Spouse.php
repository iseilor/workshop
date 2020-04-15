<?php

namespace app\modules\user\models;

use app\models\Model;
use app\modules\user\Module;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_spouse".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int $user_id
 * @property string $fio
 * @property int $gender
 * @property int $date
 * @property string|null $passport_series
 * @property string|null $passport_number
 * @property int|null $passport_date
 * @property string|null $passport_department
 * @property string|null $passport_code
 * @property string|null $passport_file
 * @property int $agree_personal_data
 * @property string|null $agree_personal_data_file
 * @property string|null $edj
 * @property string|null $edj_file
 * @property int|null $is_work
 * @property int|null $is_rtk
 * @property int|null $is_do
 * @property string|null $marriage_file
 * @property string|null $registration_file
 * @property string|null $explanatory_note_file
 * @property string|null $work_file
 * @property string|null $unemployment_file
 * @property string|null $salary_file
 */
class Spouse extends Model
{
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
            [['fio', 'gender', 'date'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'gender', 'date', 'passport_date', 'agree_personal_data', 'is_work', 'is_rtk', 'is_do'], 'integer'],
            [['fio', 'passport_series', 'passport_number', 'passport_department', 'passport_code', 'passport_file', 'agree_personal_data_file', 'edj', 'edj_file', 'marriage_file', 'registration_file', 'explanatory_note_file', 'work_file', 'unemployment_file', 'salary_file'], 'string', 'max' => 255],
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

            'user_id' => Module::t('spouse', 'User ID'),
            'fio' => Module::t('spouse', 'Fio'),
            'gender' => Module::t('spouse', 'Gender'),
            'date' => Module::t('spouse', 'Date'),
            'passport_series' => Module::t('spouse', 'Passport Series'),
            'passport_number' => Module::t('spouse', 'Passport Number'),
            'passport_date' => Module::t('spouse', 'Passport Date'),
            'passport_department' => Module::t('spouse', 'Passport Department'),
            'passport_code' => Module::t('spouse', 'Passport Code'),
            'passport_file' => Module::t('spouse', 'Passport File'),
            'agree_personal_data' => Module::t('spouse', 'Agree Personal Data'),
            'agree_personal_data_file' => Module::t('spouse', 'Agree Personal Data File'),
            'edj' => Module::t('spouse', 'Edj'),
            'edj_file' => Module::t('spouse', 'Edj File'),
            'is_work' => Module::t('spouse', 'Is Work'),
            'is_rtk' => Module::t('spouse', 'Is Rtk'),
            'is_do' => Module::t('spouse', 'Is Do'),
            'marriage_file' => Module::t('spouse', 'Marriage File'),
            'registration_file' => Module::t('spouse', 'Registration File'),
            'explanatory_note_file' => Module::t('spouse', 'Explanatory Note File'),
            'work_file' => Module::t('spouse', 'Work File'),
            'unemployment_file' => Module::t('spouse', 'Unemployment File'),
            'salary_file' => Module::t('spouse', 'Salary File'),
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
}
