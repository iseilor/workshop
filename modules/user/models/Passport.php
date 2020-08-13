<?php

namespace app\modules\user\models;

use app\models\Model;
use app\modules\user\Module;
use yii\behaviors\TimestampBehavior;

/**
 * Class Passport
 * @package app\modules\user\models
 *
 * @property int        $passport_series
 * @property int        $passport_number
 * @property int        $passport_date
 * @property string     $passport_code
 * @property string     $passport_department
 * @property string     $passport_registration
 * @property string     $address_fact
 * @property string     $passport_file
 * @property string     $ejd_file
 * @property boolean    $is_temporary_registered
 * @property string     $temporary_registration_file
 */
class Passport extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['passport_series', 'passport_number', 'passport_registration', 'passport_department', 'passport_code', 'address_fact'],
                'string', 'max' => 255,],
            [['ejd_file', 'temporary_registration_file',], 'string', 'max' => 256,],

            [['passport_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'passport_date'],

            [['passport_series', 'passport_number', 'passport_registration', 'passport_department', 'passport_code', 'passport_date', 'address_fact'], 'required'],

            // Файлы
            [['passport_file',], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => '5000000',],
            [['ejd_file',], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => '5000000',],
            [['temporary_registration_file',], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => '5000000',],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
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
        ];
    }

    public function attributeHints()
    {
        return [
            'passport_department' => '<strong>Пример</strong>: МВД Тверского района, г.Москва',
            'passport_registration' => 'Адрес регистрации из паспорта, вида: 123456, г.Москва, ул.Ленина, д.1, кв.1',
            'address_fact' => 'Пример заполнения: 123456, г.Москва, ул.Ленина, д.1, кв.1',
            'ejd_file' => ' Единый жилищный документ (действителен в течение 1 месяца со дня выдачи); 
            (если в населенном пункте не выдается ЕЖД, могут быть предоставлены выписки из домовой книги и справки о составе семьи)',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }


    public function save($runValidation = true, $attributeNames = null)
    {
        // This is fake RO model
        return false;
    }

    public function update($runValidation = true, $attributeNames = null)
    {
        // This is fake RO model
        return false;
    }



}