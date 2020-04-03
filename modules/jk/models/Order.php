<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "jk_order".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int $status_id
 *
 * @property int $salary
 * @property int $jp_type
 * @property int $jp_own
 * @property string ipoteka_file_dogovor
 * @property string ipoteka_file_grafic_first
 * @property string ipoteka_file_grafic_now
 * @property string ipoteka_file_refenance
 * @property string ipoteka_file_spravka
 * @property string ipoteka_file_bank_approval
 */
class Order extends Model
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'integer'],

            // Общие параметры заявки
            [['is_participate'], 'safe'],

            // Семья
            [['is_spouse', 'spouse_fio', 'spouse_is_dzo', 'spouse_is_do', 'spouse_is_work', 'child_count', 'child_count_18', 'child_count_23'], 'safe'],
            [['family_own', 'family_rent', 'family_address', 'family_deal'], 'safe'],

            // Жилое помещение
            [['jp_type', 'jp_params', 'jp_date', 'jp_dist', 'jp_own', 'jp_part'], 'safe'],
            [['jp_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'jp_date'],

            // Ипотека
            [['ipoteka_target', 'ipoteka_size', 'ipoteka_params', 'ipoteka_user', 'ipoteka_summa'], 'safe'],
            [
                ['ipoteka_file_dogovor', 'ipoteka_file_grafic_first', 'ipoteka_file_grafic_now', 'ipoteka_file_refenance', 'ipoteka_file_spravka', 'ipoteka_file_bank_approval'],
                'file',
                'extensions' => 'pdf, docx',
            ],
            [
                ['ipoteka_file_dogovor', 'ipoteka_file_grafic_first', 'ipoteka_file_grafic_now', 'ipoteka_file_refenance', 'ipoteka_file_spravka', 'ipoteka_file_bank_approval'],
                'file',
                'maxSize' => '2048000',
            ],


            // Доходы
            [['salary', 'total_sum_income', 'total_sum_nalog', 'month_pay', 'month_my_pay'], 'safe'],
            [
                ['salary'],
                'filter',
                'filter' => function ($value) {
                    return str_replace(" ", "", $value);
                },
            ],


            [['mortgage_file'], 'safe'],
            [['mortgage_file'], 'file', 'extensions' => 'pdf, docx'],
            [['mortgage_file'], 'file', 'maxSize' => '2048000'],
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

            'is_mortgage' => Module::t('module', 'Is Mortgage'),
            'mortgage_file' => Module::t('module', 'Mortgage File'),

            // Семья
            'is_spouse' => Module::t('module', 'Is Spouse'),
            'spouse_fio' => Module::t('module', 'Spouse Fio'),
            'spouse_is_dzo' => Module::t('module', 'Spouse Is Dzo'),
            'spouse_is_do' => Module::t('module', 'Spouse Is Do'),
            'spouse_is_work' => Module::t('module', 'Spouse Is Work'),
            'child_count' => Module::t('module', 'Child Count'),
            'child_count_18' => Module::t('module', 'Child Count 18'),
            'child_count_23' => Module::t('module', 'Child Count 23'),
            'family_own' => Module::t('order', 'Family Own'),
            'family_rent' => Module::t('order', 'Family Rent'),
            'family_address' => Module::t('order', 'Family Address'),
            'family_deal' => Module::t('order', 'Family Deal'),

            // Жилое помещение
            'jp_type' => Module::t('order', 'Jp Type'),
            'jp_params' => Module::t('order', 'Jp Params'),
            'jp_date' => Module::t('order', 'Jp Date'),
            'jp_dist' => Module::t('order', 'Jp Dist'),
            'jp_own' => Module::t('order', 'Jp Own'),
            'jp_part' => Module::t('order', 'Jp Part'),

            // Ипотека
            'ipoteka_target' => Module::t('order', 'Ipoteka Target'),
            'ipoteka_size' => Module::t('order', 'Ipoteka Size'),
            'ipoteka_user' => Module::t('order', 'Ipoteka User'),
            'ipoteka_params' => Module::t('order', 'Ipoteka Params'),
            'ipoteka_summa' => Module::t('order', 'Ipoteka Summa'),

            'ipoteka_file_dogovor' => Module::t('order', 'Ipoteka File Dogovor'),
            'ipoteka_file_grafic_first' => Module::t('order', 'Ipoteka File Grafic First'),
            'ipoteka_file_grafic_now' => Module::t('order', 'Ipoteka File Grafic Now'),
            'ipoteka_file_refenance' => Module::t('order', 'Ipoteka File Refenance'),
            'ipoteka_file_spravka' => Module::t('order', 'Ipoteka File Spravka'),
            'ipoteka_file_bank_approval' => Module::t('order', 'Ipoteka File Bank Approval'),


            'is_participate' => Module::t('module', 'Is Participate'),
            'percent_sum' => Module::t('module', 'Percent Sum'),
            'target_mortgage' => Module::t('module', 'Target Mortgage'),
            'property_type' => Module::t('module', 'Property Type'),

            // Доходы
            'salary' => Module::t('module', 'Salary'),
            'total_sum_income' => Module::t('module', 'Total Sum Income'),
            'total_sum_nalog' => Module::t('module', 'Total Sum Nalog'),
            'month_pay' => Module::t('module', 'Month Pay'),
            'month_my_pay' => Module::t('module', 'Month My Pay'),

        ];
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    // Загрузка файлов
    public function upload()
    {
        // Создаём директорию для файлов
        $pathDir = Yii::$app->params['module']['jk']['order']['filePath'] . $this->id;
        FileHelper::createDirectory($pathDir, $mode = 0775, $recursive = true);


        $this->mortgage_file = UploadedFile::getInstance($this, 'mortgage_file');
        if ($this->mortgage_file) {

            $fileName = 'mortgage_file_' . $this->id . '.' . $this->mortgage_file->extension;
            $this->mortgage_file->saveAs($pathDir . '/' . $fileName);
            $this->mortgage_file = $fileName;
        }
        return true;
    }

    //
    public function beforeValidate()
    {
        // Пробелы в деньгах
        //$this->salary = str_replace(" ", "", $this->salary);

        return parent::beforeValidate();
    }

    // Оформлена ипотека
    public static function getMortgageList()
    {
        return [
            1 => 'Да',
            0 => 'Нет',
        ];
    }

    // Ранее не участваоли в программе
    public static function getParticipateList()
    {
        return [
            1 => 'Да, участвовали',
            0 => 'Нет, не участвовали',
        ];
    }

    // Тип жилого помещения
    public static function getJPTypeList()
    {
        return [
            1 => 'Покупка квартиры (новостройка)',
            2 => 'Покупка квартиры (вторичка)',
            3 => 'Покупка дома',
            4 => 'Строительство дома',
        ];
    }

    // Расшифровака типа жилого помещения
    public static function getJPTypeName($id = null)
    {
        if ($id) {
            return (self::getJPTypeList()[$id]) ? self::getJPTypeList()[$id] : 'Неверный тип жилого помещения';
        } else {
            return false;
        }
    }

    // Тип собственности жилого помещения
    public static function getJPOwnList()
    {
        return [
            1 => 'Собственность',
            2 => 'Общая совместная собственность',
            3 => 'Общая долевая собственность',
            4 => 'Долевая собственность',
        ];
    }

    // Расшифровака типа собственности
    public static function getJPOwnName($id = null)
    {
        if ($id) {
            return (self::getJPOwnList()[$id]) ? self::getJPOwnList()[$id] : 'Неверный тип собственности';
        } else {
            return false;
        }
    }

    // Цель ипотечного договора
    public static function getIpotekaTargetList()
    {
        return [
            1 => 'Приобретение объекта недвижимости',
            2 => 'Приобретение и др неотделимые улучшения объекта недвижимости',
        ];
    }

    // Расшифровка цели ипотечного договора
    public static function getIpotekaTargetName($id = null)
    {
        if ($id) {
            return (self::getIpotekaTargetList()[$id]) ? self::getIpotekaTargetList()[$id] : 'Неверный тип собственности';
        } else {
            return false;
        }
    }

}