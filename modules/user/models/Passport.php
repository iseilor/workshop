<?php

namespace app\modules\user\models;

use app\models\Model;
use app\modules\user\Module;
use yii\behaviors\TimestampBehavior;

/**
 * Class Passport
 * @package app\modules\user\models
 *
 * @property int         $passport_series
 * @property int         $passport_number
 * @property int         $passport_date
 * @property string      $passport_code
 * @property string      $passport_department
 * @property string      $passport_registration
 * @property string      $address_fact
 * @property string      $passport_file
 *
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
            [['passport_series', 'passport_number', 'passport_registration', 'passport_department', 'passport_code'],
                'string', 'max' => 255,],

            [['passport_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'passport_date'],

            [['passport_series', 'passport_number', 'passport_registration', 'passport_department', 'passport_code', 'passport_date'], 'required'],

            // Файлы
            [['passport_file',], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => '5000000',],
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
        ];
    }

    public function attributeHints()
    {
        return [
            'passport_department' => '<strong>Пример</strong>: МВД Тверского района, г.Москва',
            'passport_registration' => 'Адрес регистрации из паспорта, вида: 123456, г.Москва, ул.Ленина, д.1, кв.1',
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