<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "jk_order".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int      $status_id
 *
 * @property boolean  $is_participate
 * @property boolean  $is_mortgage
 * @property int      $type
 *
 * @property int      $salary
 * @property int      $jp_type
 * @property int      $jp_own
 *
 * @property string   file_family_big
 * @property string   file_social_protection
 * @property string   file_rent
 * @property string   file_social_contract
 *
 * @property string   ipoteka_file_dogovor
 * @property string   ipoteka_file_dogovor_form
 * @property string   ipoteka_file_grafic_first
 * @property string   ipoteka_file_grafic_now
 * @property string   ipoteka_file_refenance
 * @property string   ipoteka_file_spravka
 * @property string   ipoteka_file_bank_approval
 *
 * @property double   money_oklad
 * @property double   money_summa_year
 * @property double   money_nalog_year
 * @property double   money_month_pay
 * @property double   money_my_pay
 */
class Order extends Model
{

    const TYPE_PERCENT = 1;

    const TYPE_ZAIM = 2;

    public $file_agree_personal_data_form;

    public $file_family_big_form;

    public $file_social_protection_form;

    public $file_rent_form;

    public $file_social_contract_form;

    public $ipoteka_file_dogovor_form = '';

    public $ipoteka_file_grafic_first_form = '';

    public $ipoteka_file_grafic_now_form = '';

    public $ipoteka_file_refenance_form = '';

    public $ipoteka_file_spravka_form = '';

    public $ipoteka_file_bank_approval_form = '';

    /**
     * @var mixed|null
     */

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

            // Общие параметры заявки
            [['is_participate', 'is_mortgage'], 'required'],
            [['is_agree_personal_data'], 'required'],
            [['is_agree_personal_data'], 'compare', 'compareValue' => 1, 'message' => 'Обязательно дать согласие на обработку персональных данных'],
            [['file_agree_personal_data_form'], 'safe'],
            [['file_agree_personal_data_form'], 'file', 'extensions' => 'pdf, docx', 'maxSize' => '2048000'],

            // Семья
            [['family_own', 'family_rent', 'family_address', 'family_deal', 'social_id', 'resident_count', 'resident_type', 'resident_own'], 'safe'],
            [['file_family_big_form', 'file_social_protection_form', 'file_rent_form', 'file_social_contract_form'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => '2048000'],

            // Супруга
            [['is_spouse', 'spouse_fio', 'spouse_is_dzo', 'spouse_is_do', 'spouse_is_work'], 'safe'],


            // Жилое помещение
            [['jp_type', 'jp_params', 'jp_date', 'jp_dist', 'jp_own', 'jp_part'], 'safe'],
            [['jp_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'jp_date'],

            // Ипотека
            [['ipoteka_target', 'ipoteka_size', 'ipoteka_params', 'ipoteka_user', 'ipoteka_summa'], 'safe'],
            [
                [
                    'ipoteka_file_dogovor_form',
                    'ipoteka_file_grafic_first_form',
                    'ipoteka_file_grafic_now_form',
                    'ipoteka_file_refenance_form',
                    'ipoteka_file_spravka_form',
                    'ipoteka_file_bank_approval_form',
                ],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'pdf, docx',
                'maxSize' => '2048000',
            ],

            // Финансы
            [['money_oklad', 'money_summa_year', 'money_nalog_year', 'money_month_pay', 'money_my_pay'], 'safe'],


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

            // Параметры
            'is_agree_personal_data' => Module::t('order', 'Agree Personal Data'),
            'file_agree_personal_data' => Module::t('order', 'Agree Personal Data'),
            'file_agree_personal_data_form' => Module::t('order', 'Agree Personal Data'),
            'is_mortgage' => Module::t('module', 'Is Mortgage'),
            'mortgage_file' => Module::t('module', 'Mortgage File'),
            'is_participate' => Module::t('module', 'Is Participate'),
            'participateLabel' => Module::t('module', 'Is Participate'),
            'type'=>Module::t('order','Type'),
            'typeName'=>Module::t('order','Type'),
            'statusName'=>Module::t('order','Status'),


            // Семья
            'social_id' => Module::t('order', 'Social'),
            'resident_count' => Module::t('order', 'Resident Count'),
            'resident_type' => Module::t('order', 'Resident Type'),
            'resident_own' => Module::t('order', 'Resident Own'),
            'file_family_big' => Module::t('order', 'File Family Big'),
            'file_social_protection' => Module::t('order', 'File Social Protection'),
            'file_rent' => Module::t('order', 'File Rent'),
            'file_social_contract' => Module::t('order', 'File Social Contract'),
            'file_family_big_form' => Module::t('order', 'File Family Big'),
            'file_social_protection_form' => Module::t('order', 'File Social Protection'),
            'file_rent_form' => Module::t('order', 'File Rent'),
            'file_social_contract_form' => Module::t('order', 'File Social Contract'),

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

            'ipoteka_file_dogovor_form' => Module::t('order', 'Ipoteka File Dogovor'),
            'ipoteka_file_grafic_first_form' => Module::t('order', 'Ipoteka File Grafic First'),
            'ipoteka_file_grafic_now_form' => Module::t('order', 'Ipoteka File Grafic Now'),
            'ipoteka_file_refenance_form' => Module::t('order', 'Ipoteka File Refenance'),
            'ipoteka_file_spravka_form' => Module::t('order', 'Ipoteka File Spravka'),
            'ipoteka_file_bank_approval_form' => Module::t('order', 'Ipoteka File Bank Approval'),


            'percent_sum' => Module::t('module', 'Percent Sum'),
            'target_mortgage' => Module::t('module', 'Target Mortgage'),
            'property_type' => Module::t('module', 'Property Type'),

            // Финансы
            'money_oklad' => Module::t('order', 'Money Oklad'),
            'money_summa_year' => Module::t('order', 'Money Summa Year'),
            'money_nalog_year' => Module::t('order', 'Money Nalog Year'),
            'money_month_pay' => Module::t('order', 'Money Month Pay'),
            'money_my_pay' => Module::t('order', 'Money My Pay'),
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
        // Создаём директорию для хранения файлов файлов
        $pathDir = Yii::$app->params['module']['jk']['order']['filePath'] . $this->id;
        FileHelper::createDirectory($pathDir, $mode = 0775, $recursive = true);


        // Все поля с файлами
        $fields = [
            'file_agree_personal_data',     // Персональные данные
            'file_family_big',              // Удостоверение многодетной семьи
            'file_social_protection',       // Справка из социальной защиты
            'file_rent',                    // Договор аренды
            'file_social_contract',         // Договор социального найма
        ];

        // Сохраняем данные
        foreach ($fields as $field) {
            $file = UploadedFile::getInstance($this, $field . '_form');
            if ($file) {
                $fileName = 'jk_order_' . $this->id . '_' . $field . '_' . date('YmdHis') . '.' . $file->extension;
                $file->saveAs($pathDir . '/' . $fileName);
                $this->{$field} = $fileName;
            }
        }

        $ipoteka_file_dogovor = UploadedFile::getInstance($this, 'ipoteka_file_dogovor_form');
        if ($ipoteka_file_dogovor) {
            $fileName = 'jk_order_' . $this->id . '_ipoteka_file_dogovor_' . date('YmdHis') . '.' . $ipoteka_file_dogovor->extension;
            $ipoteka_file_dogovor->saveAs($pathDir . '/' . $fileName);
            $this->ipoteka_file_dogovor = $fileName;
        }

        $ipoteka_file_grafic_first = UploadedFile::getInstance($this, 'ipoteka_file_grafic_first_form');
        if ($ipoteka_file_grafic_first) {
            $fileName = 'jk_order_' . $this->id . '_ipoteka_file_grafic_first_' . date('YmdHis') . '.' . $ipoteka_file_grafic_first->extension;
            $ipoteka_file_grafic_first->saveAs($pathDir . '/' . $fileName);
            $this->ipoteka_file_grafic_first = $fileName;
        }

        $ipoteka_file_grafic_now = UploadedFile::getInstance($this, 'ipoteka_file_grafic_now_form');
        if ($ipoteka_file_grafic_now) {
            $fileName = 'jk_order_' . $this->id . '_ipoteka_file_grafic_now_' . date('YmdHis') . '.' . $ipoteka_file_grafic_now->extension;
            $ipoteka_file_grafic_now->saveAs($pathDir . '/' . $fileName);
            $this->ipoteka_file_grafic_now = $fileName;
        }

        $ipoteka_file_refenance = UploadedFile::getInstance($this, 'ipoteka_file_refenance_form');
        if ($ipoteka_file_refenance) {
            $fileName = 'jk_order_' . $this->id . '_ipoteka_file_refenance_' . date('YmdHis') . '.' . $ipoteka_file_refenance->extension;
            $ipoteka_file_refenance->saveAs($pathDir . '/' . $fileName);
            $this->ipoteka_file_refenance = $fileName;
        }

        $ipoteka_file_spravka = UploadedFile::getInstance($this, 'ipoteka_file_spravka_form');
        if ($ipoteka_file_spravka) {
            $fileName = 'jk_order_' . $this->id . '_ipoteka_file_spravka_' . date('YmdHis') . '.' . $ipoteka_file_spravka->extension;
            $ipoteka_file_spravka->saveAs($pathDir . '/' . $fileName);
            $this->ipoteka_file_spravka = $fileName;
        }

        $ipoteka_file_bank_approval = UploadedFile::getInstance($this, 'ipoteka_file_bank_approval_form');
        if ($ipoteka_file_bank_approval) {
            $fileName = 'jk_order_' . $this->id . '_ipoteka_file_bank_approval_' . date('YmdHis') . '.' . $ipoteka_file_bank_approval->extension;
            $ipoteka_file_bank_approval->saveAs($pathDir . '/' . $fileName);
            $this->ipoteka_file_bank_approval = $fileName;
        }

        return $this->save();
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

    // Плашка красного и зелёного цвета. Если уже участововали [1]-красный
    public function getParticipateLabel()
    {
        $title = self::getParticipateList()[$this->is_participate];
        if ($this->is_participate) {
            return '<span class="badge bg-red">' . $title . '</span>';
        } else {
            return '<span class="badge bg-green">' . $title . '</span>';
        }
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

    // Типы проживающих рядом с сотрудником
    public static function getResidentTypeList()
    {
        return [
            1 => 'Члены семьи (супруг(а), дети)',
            2 => 'Родственники',
            3 => 'Соседи',
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

    // Статус заявки
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    // Название статуса
    public function getStatusName(){
        return $this->status->title;
    }

    // Шильдик статуса
    public function getStatusBadge(){
        return Html::tag('<span>', $this->statusName, ['class' => 'badge bg-'.$this->status->color,]);
    }

    // Социальная категория
    public function getSocial()
    {
        return $this->hasOne(Social::class, ['id' => 'social_id']);
    }

    // Типы заявок
    public static function getTypesArray()
    {
        return [
            self::TYPE_PERCENT => 'Проценты',
            self::TYPE_ZAIM => 'Займ',
        ];
    }

    // Наименование типа заявки
    public function getTypeName()
    {
        return ArrayHelper::getValue(self::getTypesArray(), $this->type);
    }

    // Предварительное сохранение
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            // Сохраняем тип заявки
            if ($this->is_mortgage) {
                $this->type = self::TYPE_PERCENT;
            } else {
                $this->type = self::TYPE_ZAIM;
            }
            return true;
        }
        return false;
    }
}