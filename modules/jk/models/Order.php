<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use kartik\icons\Icon;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
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
 * @property double   ipoteka_percent
 * @property string   ipoteka_file_dogovor
 * @property string   ipoteka_file_dogovor_form
 * @property string   ipoteka_file_grafic_first
 * @property string   ipoteka_file_grafic_now
 * @property string   ipoteka_file_refenance
 * @property string   ipoteka_file_spravka
 * @property string   ipoteka_file_bank_approval
 *
 * @property double   money_oklad
 * @property string   ndfl2_file
 * @property boolean  is_do
 * @property string   spravka_zp_file
 * @property double   money_summa_year
 * @property double   money_nalog_year
 * @property double   money_month_pay
 * @property double   money_user_pay
 *
 * @property integer $resident_own_type
 * @property boolean $is_poor
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

    public $jp_dogovor_buy_file_form;

    public $jp_act_file_form;

    public $jp_egrp_file_form;

    public $jp_own_land_file_form;

    public $jp_own_house_file_form;

    public $jp_dogovor_bron_file_form;

    public $jp_pravo_document_file_form;

    public $jp_grad_plane_file_form;

    public $jp_scheme_plane_org_file_form;

    public $jp_building_permit_file_form;

    public $jp_project_house_file_form;

    public $jp_construction_estimate_file_form;

    public $jp_time_grafic_build_file_form;

    public $jp_photo_file_form;

    public $jp_template_report_file_form;

    public $ipoteka_file_dogovor_form = '';

    public $ipoteka_file_grafic_first_form = '';

    public $ipoteka_file_grafic_now_form = '';

    public $ipoteka_file_refenance_form = '';

    public $ipoteka_file_spravka_form = '';

    public $ipoteka_file_bank_approval_form = '';

    public $ndfl2_file_form;

    public $spravka_zp_file_form;

    public $cnt; // Нужно для группировки

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
        $rules = [

            // Общие параметры заявки
            [['is_participate', 'is_mortgage'], 'required'],
            [['percent_id', 'zaim_id'], 'safe'],
            [['file_agree_personal_data_form'], 'safe'],
            [['file_agree_personal_data_form'], 'file', 'extensions' => 'pdf, docx', 'maxSize' => '10000000'],
            [['is_poor'], 'safe'],

            // Семья
            [['social_id', 'resident_count', /*'resident_type',*/ 'family_deal', /*'resident_own',*/ 'family_own', 'family_address', 'resident_own_type'], 'required'],
            [['resident_count', 'jp_room_count'], 'integer'],
            [['family_rent'], 'safe'],
            [['file_family_big_form', 'file_social_protection_form', 'file_rent_form', 'file_social_contract_form'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => '10000000'],
            [['resident_own_type'], 'integer'],

            // Супруга
            [['is_spouse', 'spouse_fio', 'spouse_is_dzo', 'spouse_is_do', 'spouse_is_work'], 'safe'],


            // Жилое помещение
            [['jp_type', 'jp_area'], 'required'],
            [
                [
                    'jp_type',
                    'jp_address',
                    'jp_room_count',
                    'jp_area',
                    'jp_cost',
                    'jp_dogovor_date',
                    'jp_registration_date',
                    'jp_date',
                    'jp_dist',
                    'jp_own',
                    'jp_part',
                ],
                'safe',
            ],
            [['jp_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'jp_date'],
            [['jp_dogovor_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'jp_dogovor_date'],
            [['jp_registration_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'jp_registration_date'],


            // Ипотека
            [['is_mortgage', 'ipoteka_target', 'ipoteka_size', 'ipoteka_user'], 'required'],
            [['ipoteka_last_date', 'ipoteka_percent'], 'safe'],
            [['ipoteka_last_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'ipoteka_last_date'],
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
                'maxSize' => '20048000',
            ],

            // Финансы
            [['money_oklad', 'money_summa_year', 'money_nalog_year', 'money_month_pay', 'money_user_pay'], 'required'],
            [['is_do'], 'safe'],
            [
                [
                    'ndfl2_file_form',
                    'spravka_zp_file_form',
                ],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'pdf, docx',
                'maxSize' => '20048000',
            ],

        ];

        if (!$this->file_agree_personal_data) {
            $rules[] = [['file_agree_personal_data_form'], 'required','skipOnEmpty' => true,];
        }

        return $rules;
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

            'createdUserLabel' => Module::t('order', 'User'),
            'createdUserLink' => Module::t('order', 'User'),
            'status.label'=> Module::t('order', 'Status'),

            // Параметры
            'file_agree_personal_data' => Module::t('order', 'Agree Personal Data'),
            'file_agree_personal_data_form' => Module::t('order', 'Agree Personal Data'),
            'is_mortgage' => Module::t('order', 'Is Mortgage'),
            'mortgage_file' => Module::t('module', 'Mortgage File'),
            'is_participate' => Module::t('order', 'Is Participate'),
            'participateLabel' => Module::t('module', 'Is Participate'),
            'type' => Module::t('order', 'Type'),
            'typeName' => Module::t('order', 'Type'),
            'statusName' => Module::t('order', 'Status'),

            // Работник
            'is_poor' => Module::t('order', 'Is Poor'),

            // Семья
            'social_id' => Module::t('order', 'Social'),
            'resident_count' => Module::t('order', 'Resident Count'),
            'resident_type' => Module::t('order', 'Resident Type'),
            'resident_own' => Module::t('order', 'Resident Own'),
            'resident_own_type' => Module::t('order', 'Resident Own Type'),
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
            'jp_address' => Module::t('order', 'JP Address'),
            'jp_room_count' => Module::t('order', 'JP Room Count'),
            'jp_area' => Module::t('order', 'JP Area'),
            'jp_cost' => Module::t('order', 'JP Cost'),
            'jp_dogovor_date' => Module::t('order', 'JP Dogovor Date'),
            'jp_registration_date' => Module::t('order', 'JP Registration Date'),
            'jp_date' => Module::t('order', 'Jp Date'),
            'jp_dist' => Module::t('order', 'Jp Dist'),
            'jp_own' => Module::t('order', 'Jp Own'),
            'jp_part' => Module::t('order', 'Jp Part'),

            // Жилое помещение. Файлы
            'jp_dogovor_buy_file_form' => Module::t('order', 'JP Dogovor Buy'),
            'jp_act_file_form' => Module::t('order', 'JP Act'),
            'jp_egrp_file_form' => Module::t('order', 'JP EGRP'),
            'jp_own_land_file_form' => Module::t('order', 'JP Own Land'),
            'jp_own_house_file_form' => Module::t('order', 'JP Own House'),

            'jp_dogovor_buy_file' => Module::t('order', 'JP Dogovor Buy'),
            'jp_act_file' => Module::t('order', 'JP Act'),
            'jp_egrp_file' => Module::t('order', 'JP EGRP'),
            'jp_own_land_file' => Module::t('order', 'JP Own Land'),
            'jp_own_house_file' => Module::t('order', 'JP Own House'),

            // Жилое помещения. Займ. Файлы
            'jp_dogovor_bron_file' => Module::t('order', 'JP Dogovor Bron'),
            'jp_pravo_document_file' => Module::t('order', 'JP Pravo Document'),
            'jp_grad_plane_file' => Module::t('order', 'JP Grad Plan'),
            'jp_scheme_plane_org_file' => Module::t('order', 'JP Scheme Plane Org'),
            'jp_building_permit_file' => Module::t('order', 'JP Building Permit'),
            'jp_project_house_file' => Module::t('order', 'JP Project House'),
            'jp_construction_estimate_file' => Module::t('order', 'JP Construction Estimate'),
            'jp_time_grafic_build_file' => Module::t('order', 'JP Time Grafic Build'),
            'jp_photo_file' => Module::t('order', 'JP Photo'),
            'jp_template_report_file' => Module::t('order', 'JP Template'),

            'jp_dogovor_bron_file_form' => Module::t('order', 'JP Dogovor Bron'),
            'jp_pravo_document_file_form' => Module::t('order', 'JP Pravo Document'),
            'jp_grad_plane_file_form' => Module::t('order', 'JP Grad Plan'),
            'jp_scheme_plane_org_file_form' => Module::t('order', 'JP Scheme Plane Org'),
            'jp_building_permit_file_form' => Module::t('order', 'JP Building Permit'),
            'jp_project_house_file_form' => Module::t('order', 'JP Project House'),
            'jp_construction_estimate_file_form' => Module::t('order', 'JP Construction Estimate'),
            'jp_time_grafic_build_file_form' => Module::t('order', 'JP Time Grafic Build'),
            'jp_photo_file_form' => Module::t('order', 'JP Photo'),
            'jp_template_report_file_form' => Module::t('order', 'JP Template'),

            // Ипотека
            'ipoteka_target' => Module::t('order', 'Ipoteka Target'),
            'ipoteka_size' => Module::t('order', 'Ipoteka Size'),
            'ipoteka_user' => Module::t('order', 'Ipoteka User'),
            'ipoteka_params' => Module::t('order', 'Ipoteka Params'),
            'ipoteka_summa' => Module::t('order', 'Ipoteka Summa'),
            'ipoteka_percent' => Module::t('order', 'Ipoteka Percent'),
            'ipoteka_last_date' => Module::t('order', 'Ipoteka Last Date'),
            'ipoteka_grafic' => Module::t('order', 'Ipoteka Grafic'),

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
            'money_user_pay' => Module::t('order', 'Money User Pay'),
            'ndfl2_file' => Module::t('order', '2 NDFL'),
            'ndfl2_file_form' => Module::t('order', '2 NDFL'),
            'spravka_zp_file' => Module::t('order', 'Spravka ZP'),
            'spravka_zp_file_form' => Module::t('order', 'Spravka ZP'),
            'is_do' => Module::t('order', 'Is DO'),
        ];
    }

    public function attributeHints()
    {
        return [

            // Семья
            'social_id' => '<strong>Малоимущие</strong> - Пользователи со среднедушевым доходом в семье ниже прожиточного минимума, установленного в соответствующем субъекте РФ.<br>
                            <strong>Родители-одиночки</strong> - Пользователи, в одиночку воспитывающие одного и более ребенка в возрасте до 18 лет (в случае обучения ребенка в высшем учебном заведении - до 23 лет).<br/>
                            <strong>Многодетные</strong> - Пользователи, имеющие 3 и более детей в возрасте до 18 лет (в случае обучения ребенка в высшем учебном заведении - до 23 лет) в одной семье.<br/>
                            <strong>Иные Пользователи</strong> - по решению жилищной комиссии и/или директора филиала.',
            'family_own' => 'ФИО каждого члена семьи: доля, кол-во комнат, адрес, общяя площадь<br/><strong>Пример:</strong><br>
                            Иванов И.И. владеет ½ долей в 1-комнатной квартире: 111112 г. Москва, ул. Нагатинская, д.2, стр.2, кв. 2, 1 комната, общей площадью 30 кв.м.<br/>
                            Иванов М.И. не владеет жилыми помещениями.<br>
                            Иванова О.И. не владеет жилыми помещениями.<br>',
            'family_deal' => 'При наличии сделки указывается: дата, тип сделки, адрес, кол-во комнат, общая площадь, доля в собственности<br><strong>Пример:</strong><br/>
                            Иванов И.И. получила 21.12.2018 в наследство 1/7 в 2-комнатной квартире по адресу: 222222 г. Москва, ул. Нагатинская, д.3, стр.5, кв. 10, общей площадью 36,2 кв.м.<br>
                            Иванова И.И. - сделок не было',
            'family_address' => '<strong>Пример:</strong> 111111 г. Москва, ул. Нагатинская, д.1, стр.26, кв. 200, собственность моей матери, 2-х комнатная квартира, общей площадью 43 кв.м., фактически проживает 10 человек (с соседями/ родственниками).',
            'resident_own' => 'Если фактический адрес проживания отличается от адреса регистрации, то по фактическому адресу уточняется чья это собственность',
            'family_rent' => 'Договор найма либо у Пользователя, либо Пользователь проживает в квартире, оформленной по договору социального найма.<br/><strong>Пример:</strong> ФИО, кол-во комнат, адрес, общая площадь',
            'file_rent_form' => '',
            'file_social_contract_form' => '',

            'jp_building_permit_file_form' => 'Документ, выдаваемый федеральным органом исполнительной власти, органом исполнительной власти субьекта РФ или органом местного самоуправления в соответствии с их компетенции. схема планировочной организации земельного участка с обозначением места размещения объекта индивидуального жилищного строительства',
            'jp_scheme_plane_org_file_form' => 'C обозначением места размещения объекта индивидуального жилищного строительства/дома',

            'ipoteka_last_date' => 'Последняя дата платежа по ипотечному договору',
            'ipoteka_grafic' => 'Сумма процентов подлежащая к уплате за текущий год согласно Графику платежей ипточеного договора (по месячно, без учета основного долга).<br/>Пример:<br/>02.01.2020 15 000 руб<br/>02.02.2020 14 500 руб.<br/>...',
            'money_oklad' => 'Указывается на основании 2НДФЛ',
            'money_summa_year' => 'Раздел 5 2НДФЛ',
            'money_nalog_year' => 'Раздел 5 2НДФЛ',

            'money_month_pay' => 'После оказания помощи совокупные среднемесячные платежи моей семьи по всем обязательствам, руб',
            'money_user_pay' => 'После оказания помощи совокупные мои платежи, руб',

            'file_agree_personal_data_form' => 'Скачайте автоматически сформированный '.Html::a(Icon::show('file-pdf') .'бланк', Url::to(['/user/user/' . Yii::$app->user->identity->id . '/pd'])).', который нужно будет распечатать, подписать и прикрепить в поле',
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
        FileHelper::createDirectory($pathDir, $mode = 0777, $recursive = true);

        // Все поля с файлами
        $fields = [
            'file_agree_personal_data',     // Персональные данные
            'file_family_big',              // Удостоверение многодетной семьи
            'file_social_protection',       // Справка из социальной защиты
            'file_rent',                    // Договор аренды
            'file_social_contract',         // Договор социального найма

            'jp_dogovor_buy_file',
            'jp_act_file',
            'jp_egrp_file',
            'jp_own_land_file',
            'jp_own_house_file',

            'jp_dogovor_bron_file',
            'jp_pravo_document_file',
            'jp_grad_plane_file',
            'jp_scheme_plane_org_file',
            'jp_building_permit_file',
            'jp_project_house_file',
            'jp_construction_estimate_file',
            'jp_time_grafic_build_file',
            'jp_photo_file',
            'jp_template_report_file',

            'ipoteka_file_dogovor',
            'ipoteka_file_grafic_first',
            'ipoteka_file_grafic_now',
            'ipoteka_file_refenance',
            'ipoteka_file_spravka',
            'ipoteka_file_bank_approval',

            'ndfl2_file',
            'spravka_zp_file',
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

        return $this->save();
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
        // Изменены ID значений справочника. Т7К. система не запущена в боевую эксплуатацию, обновлене старых значений не требоуется
//        return [
//            1 => 'Покупка квартиры (новостройка)',
//            2 => 'Покупка квартиры (вторичка)',
//            3 => 'Покупка дома',
//            4 => 'Строительство дома',
//        ];

        return [
            1 => 'Дом',
            2 => 'Квартира',
            3 => 'Комната',
        ];
    }

    // Тип жилого помещения
    public static function getResidentOwnTypeList()
    {
        return [
            1 => 'Моей семьи',
            2 => 'Родственников',
            3 => 'Аренда/Прочее',
            4 => 'Социальный найм'
        ];
    }

    // Типы проживающих рядом с сотрудником
    public static function getResidentTypeList()
    {
        return [
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
    public function getStatusName()
    {
        return $this->status->title;
    }

    // Шильдик статуса
    public function getStatusBadge()
    {
        return Html::tag('<span>', $this->statusName, ['class' => 'badge bg-' . $this->status->color,]);
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

    // Правим запятые на точки в денежных полях
    public function beforeValidate()
    {
        // Заменяем запятые на точки
        $fields = ['ipoteka_percent','money_oklad','money_summa_year','money_nalog_year',
                    'money_month_pay', 'money_user_pay'
        ];
        foreach ($fields as $field) {
            $this->{$field} = str_replace(",", ".", $this->{$field});
        }
        return parent::beforeValidate();
    }

    // Загружаем данные из калькулятора процентов
    public function loadDataPercent($percent_id)
    {
        $percent = Percent::findOne($percent_id);
        $this->percent_id = $percent_id;
        $this->is_mortgage = 1;
        $this->resident_count = $percent->family_count;
        $this->jp_area = $percent->area_buy;
        $this->jp_cost = $percent->cost_total;
        $this->ipoteka_user = $percent->cost_user;
        $this->ipoteka_size = $percent->bank_credit;
        $this->ipoteka_percent = $percent->percent_rate;
    }

    // Загружаем данные из калькулятора процентов
    public function loadDataZaim($zaim_id)
    {
        $zaim = Zaim::findOne($zaim_id);
        $this->zaim_id = $zaim_id;
        $this->is_mortgage = 0;
        $this->resident_count = $zaim->family_count;
        $this->jp_area = $zaim->area_buy;
        $this->jp_cost = $zaim->cost_total;
    }
}