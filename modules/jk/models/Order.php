<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use app\modules\user\models\Child;
use app\modules\user\models\Spouse;
use app\modules\user\models\User;
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
 * @property string   $order_file
 *
 * @property int      $salarys
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
 * @property string   other_income_file
 *
 * @property integer  $resident_own_type
 * @property boolean  $is_poor
 *
 * @property integer  $filling_step
 *
 * @property User     $user
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

    public $order_file_form;

    public $other_income_file_form;

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
            [['filling_step'], 'safe'],


            // Общие параметры заявки
            [['is_participate'], 'required'],
            //            [['percent_id', 'zaim_id'], 'safe'],
            //            [['file_agree_personal_data_form'], 'safe'],
            //            [['file_agree_personal_data_form'], 'file', 'extensions' => 'pdf, docx', 'maxSize' => '10000000'],
            [['is_poor'], 'safe'],
            //
            // Семья
            [['resident_count', 'family_address', 'resident_own_type'], 'required'],


            [['resident_count', 'jp_room_count'], 'integer'],
            [['family_rent'], 'safe'],
            [
                ['file_family_big_form', 'file_social_protection_form', 'file_rent_form', 'file_social_contract_form'],
                'file',
                'skipOnEmpty' => true,
                /*'extensions' => 'pdf',*/
                'maxSize' => '10000000',
            ],
            [['resident_own_type'], 'integer'],
            //
            //            // Супруга
            //            [['is_spouse', 'spouse_fio', 'spouse_is_dzo', 'spouse_is_do', 'spouse_is_work'], 'safe'],
            //
            //
            //            // Жилое помещение
            [['jp_type', 'jp_area'], 'required'],
            [
                [
                    'under_construction',
                    'district_id',
                    'is_parts',
                    'jp_total_area',
                    'jp_new_type',
                    'jp_new_room_count',
                    'jp_new_area',
                    'is_new_building',
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
            [['jp_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'jp_date', 'skipOnEmpty' => true,],
            [['jp_dogovor_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'jp_dogovor_date', 'skipOnEmpty' => true,],
            [['jp_registration_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'jp_registration_date', 'skipOnEmpty' => true,],
            [
                ['family_own', 'family_deal', 'jp_total_area', 'is_mortgage', 'jp_new_type', 'jp_new_area'],
                'required',
                'when' => function ($model) {
                    return $model->filling_step >= 4;
                },
                'whenClient' => "function (attribute, value) {
                    return $('#order-filling_step').val() >= 4;
                }",
            ],
            //
            //
            //            // Ипотека
            //            [['is_mortgage',   ], 'required'],


            // Вкладка "Семья"
            /*[
                ['social_id', 'family_own', 'family_deal'],
                'required',
                'when' => function ($model) {
                    return $model->filling_step >= 4;
                },
                'whenClient' => "function (attribute, value) {
                    return $('#order-filling_step').val() >= 4;
                }",
            ],*/


            // Вкладка "Ипотека"
            [['ipoteka_last_date', 'ipoteka_percent', 'zaim_sum', 'ipoteka_start_date'], 'safe'],
            [['ipoteka_last_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'ipoteka_last_date', 'skipOnEmpty' => true,],
            [['ipoteka_start_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'ipoteka_start_date', 'skipOnEmpty' => true,],
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
                //                'extensions' => 'pdf, docx',
                'maxSize' => '20048000',
            ],

            [
                ['jp_cost', 'ipoteka_size', 'ipoteka_user'],
                'required',
                'when' => function ($model) {
                    return $model->filling_step >= 5;
                },
                'whenClient' => "function (attribute, value) {
                    return $('#order-filling_step').val() >= 5;
                }",
            ],


            // Вкладка "Финансы"
            [
                ['money_summa_year', 'money_nalog_year', 'money_month_pay', 'money_user_pay',],
                'required',
                'when' => function ($model) {
                    return $model->filling_step >= 6;
                },
                'whenClient' => "function (attribute, value) {
                    return $('#order-filling_step').val() >= 6;
                }",
            ],

            [
                [
                    'ndfl2_file_form',
                    'spravka_zp_file_form',
                    'other_income_file_form',
                ],
                'file',
                'skipOnEmpty' => true,
                //                'extensions' => 'pdf, docx',
                'maxSize' => '20048000',
            ],

            [['is_do'], 'safe'],


            // Вкладка "Финансы"
            [
                ['file_agree_personal_data_form',],
                'required',
                'when' => function ($model) {
                    return $model->filling_step >= 7 && !$model->file_agree_personal_data;
                },
                'whenClient' => "function (attribute, value) {
                    return ($('#order-filling_step').val() >= 7) && (($('#order-file_agree_personal_data').val() === null) || ($('#order-file_agree_personal_data').val() === ''));
                    
                }",
                'skipOnEmpty' => true,
            ],

        ];


        //
        //        if (!$this->file_agree_personal_data) {
        //            $rules[] = [['file_agree_personal_data_form'], 'required','skipOnEmpty' => true,];
        //        }

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
            'status.label' => Module::t('order', 'Status'),

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
            'order_file' => Module::t('order', 'Order File'),
            'order_file_form' => Module::t('order', 'Order File'),

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
            'jp_new_room_count' => Module::t('order', 'JP Room Count'),
            'jp_area' => Module::t('order', 'JP Area'),
            'jp_new_area' => Module::t('order', 'JP Area'),
            'jp_cost' => Module::t('order', 'JP Cost'),
            'jp_dogovor_date' => Module::t('order', 'JP Dogovor Date'),
            'jp_registration_date' => Module::t('order', 'JP Registration Date'),
            'jp_date' => Module::t('order', 'Jp Date'),
            'jp_dist' => Module::t('order', 'Jp Dist'),
            'jp_own' => Module::t('order', 'Jp Own'),
            'jp_part' => Module::t('order', 'Jp Part'),
            'is_parts' => Module::t('order', 'Is Parts'),
            'jp_new_type' => Module::t('order', 'Jp Type'),
            'is_new_building' => Module::t('order', 'Jp New Building'),
            'jp_total_area' => Module::t('order', 'Jp Total Area'),
            'district_id' => Module::t('order', 'District'),
            'under_construction' => Module::t('order', 'Under Construction'),

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
            'zaim_sum' => Module::t('order', 'Zaim Sum'),
            'ipoteka_start_date' => Module::t('order', 'Ipoteka Start'),

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
            'other_income_file_form' => Module::t('order', 'Other Income'),
        ];
    }

    public function attributeHints()
    {
        return [

            // Семья
            'jp_part' => '<strong>Пример:</strong> 0,5',
            'social_id' => '<strong>Малоимущие</strong> - Пользователи со среднедушевым доходом в семье ниже прожиточного минимума, установленного в соответствующем субъекте РФ.<br>
                            <strong>Родители-одиночки</strong> - Пользователи, в одиночку воспитывающие одного и более ребенка в возрасте до 18 лет (в случае обучения ребенка в высшем учебном заведении - до 23 лет).<br/>
                            <strong>Многодетные</strong> - Пользователи, имеющие 3 и более детей в возрасте до 18 лет (в случае обучения ребенка в высшем учебном заведении - до 23 лет) в одной семье.<br/>
                            <strong>Иные Пользователи</strong> - по решению жилищной комиссии и/или директора филиала.',
            'family_own' => 'ФИО каждого члена семьи: доля, кол-во комнат, адрес, общяя площадь<br/><strong>Пример:</strong><br>
                            Иванов И.И. владеет ½ долей в 1-комнатной квартире: 111112 г. Москва, ул. Нагатинская, д.2, стр.2, кв. 2, 1 комната, общей площадью 30 кв.м.<br/>
                            Иванов М.И. не владеет жилыми помещениями.<br>
                            Иванова О.И. не владеет жилыми помещениями.<br>',
            'family_deal' => 'При наличии сделки указывается: дата, тип сделки, адрес, кол-во комнат, общая площадь, доля в собственности<br><strong>Пример:</strong><br/>
                            Иванов И.И. получил 21.12.2018 в наследство 1/7 в 2-комнатной квартире по адресу: 222222 г. Москва, ул. Нагатинская, д.3, стр.5, кв. 10, общей площадью 36,2 кв.м.<br>
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

            'file_agree_personal_data_form' => 'Скачайте автоматически сформированный ' . Html::a(Icon::show('file-pdf') . 'бланк',
                    Url::to(['/user/user/' . Yii::$app->user->identity->id . '/pd']))
                . ', который нужно будет распечатать, подписать и прикрепить в поле',

            'order_file_form' => 'Вам необходимо скачать автоматически сформированное ' . Html::a(Icon::show('file-pdf') . 'Заявление',
                    Url::to(['/jk/order/' . $this->id . '/order'])) . ', которое нужно распечатать, подписать и прикрепить в данное поле',
            'file_agree_personal_data_form' => 'Скачайте автоматически сформированный ' . Html::a(Icon::show('file-pdf') . 'бланк',
                    Url::to(['/user/user/' . Yii::$app->user->identity->id . '/pd']))
                . ', который нужно будет распечатать, подписать и прикрепить в поле',

            'jp_own_land_file_form' => 'Собственниками (арендаторами) земельного участка, на котором будет осуществляться строительство дома, и в последующем собственниками дома могут выступать работники/или члены его семьи.',
            'jp_project_house_file_form' => 'Разрабатывает кандидат или специализированная организация',
            'jp_construction_estimate_file_form' => 'Разрабатывает кандидат или специализированная организация',
            'jp_time_grafic_build_file_form' => 'Разрабатывает кандидат или специализированная организация',
            'jp_dogovor_buy_file_form' => 'Если договор зарегестрирован с ЭЦП, необходимо дополнительно приложить само ЭЦП',
            'jp_egrp_file_form' => 'Если ЕГРН зарегестрирован с ЭЦП, необходимо дополнительно приложить само ЭЦП. При приобретении дома необходимо вложить ЕГРН и на дом и на земельный участок',
            'other_income_file_form' => 'Прикрепляются документы о получаемых семьёй пособиях (инвалидность, безработица), стипендия и прочих доходах',
            'money_month_pay' => 'Сумма расходов по кредитам (ипотека/на личные цели, аренду квартиры)',
            'ipoteka_file_dogovor' => 'Если регистрация ипотеки электронная  необходимо её вложить доп. файлом - ЭЦП регистрации.',
            'jp_total_area' => 'В сумме также учитываются сделки по отчуждению жилых помещений, прошедшие в течение 5 лет от даты подачи заявления на Жилищную комиссию. Общая площадь считается по всем членам семьи с учетом доли собственности.',
            'jp_address' => '<strong>Пример:</strong><br/>
                111112 г. Москва, ул. Нагатинская, д.2, стр.2, кв.2, 1 комната.',
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
            'order_file',
            'other_income_file',
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
            1 => 'Да, жилье приобрел(а) и выплачиваю ипотеку',
            0 => 'Нет, только планирую приобрести жилье',
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
            4 => 'Социальный найм',
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
        $fields = [
            'ipoteka_percent',
            'money_oklad',
            'money_summa_year',
            'money_nalog_year',
            'money_month_pay',
            'money_user_pay',
            'jp_cost',
            'ipoteka_user',
            'ipoteka_size',
            'zaim_sum',
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

    // Отправить заявку на согласование руководителям
    public function sendManager()
    {
        Agreement::sendEmailManager($this->id);
    }

    // Отравить куратору
    public function sendCurator()
    {
        // Сотрудник и куратор
        $user = User::findOne($this->created_by);
        $rf = Rf::findOne($user->filial_id);
        $curator = User::findOne($rf->user_id);

        $newStatus = Status::findOne(['code' => 'CURATOR_CHECK']);
        $this->status_id = $newStatus->id;
        $this->save();

        // Сохраняем в историю движения заявки
        $orderStage = new OrderStage();
        $orderStage->order_id = $this->id;
        $orderStage->status_id = $newStatus->id;
        $orderStage->comment = $newStatus->title;
        $orderStage->save();

        // Отправляем письмо куратору
        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/check/curator',
            [
                'user' => $user,
                'curator' => $curator,
                'order' => $this,
            ]
        )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($curator->email)
            ->setBcc(Yii::$app->params['supportEmail'])
            ->setSubject($this->getEmailSubject('На проверку куратору'))
            ->send();

        // Отправляем письмо сотруднику
        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/check/user',
            [
                'user' => $user,
                'curator' => $curator,
                'order' => $this,
            ]
        )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($user->email)
            ->setBcc(Yii::$app->params['supportEmail'])
            ->setSubject($this->getEmailSubject('На проверку куратору'))
            ->send();
    }


    /**
     * Отправляем заявку куратору на проверку, после того, как сотрудник приложил все необходимые документы
     */
    public function sendCuratorDoc()
    {
        // Сотрудник и куратор
        $user = User::findOne($this->created_by);
        $rf = Rf::findOne($user->filial_id);
        $curator = User::findOne($rf->user_id);

        $newStatus = Status::findOne(['code' => 'DOC']);
        $this->status_id = $newStatus->id;
        $this->save();

        // Сохраняем в историю движения заявки
        $orderStage = new OrderStage();
        $orderStage->order_id = $this->id;
        $orderStage->status_id = $newStatus->id;
        $orderStage->comment = $newStatus->title;
        $orderStage->save();

        // Отправляем письмо куратору
        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/doc/curator',
            [
                'user' => $user,
                'curator' => $curator,
                'order' => $this,
            ]
        )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($curator->email)
            ->setBcc(Yii::$app->params['supportEmail'])
            ->setSubject($this->getEmailSubject('Оформление документов'))
            ->send();

        // Отправляем письмо сотруднику
        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/doc/user',
            [
                'user' => $user,
                'curator' => $curator,
                'order' => $this,
            ]
        )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($user->email)
            ->setBcc(Yii::$app->params['supportEmail'])
            ->setSubject($this->getEmailSubject('Оформление документов'))
            ->send();
    }

    // Однотипный заголовок по всем письмам при работе с заявкой+
    public function getEmailSubject($title)
    {
        return Yii::$app->params['senderName'] . " / Жилищная Программа / Заявка №" . $this->id . " / " . $title;
    }

    // Получаем читабельный список семьи. Нужен при формировании заявления
    public function getFamilyList()
    {

        $list = '';
        $user = User::findOne($this->created_by);

        // Супруг(а)
        $spouse = Spouse::find()->where(['user_id' => $user->id])->one();
        if ($spouse) {
            if ($user->gender) {
                $list .= 'Супруга: ';
            } else {
                $list .= 'Супруг: ';
            }
            $list .= $spouse->fio . "</w:t><w:br/><w:t>";
        }

        // Дети
        $childs = Child::find()->where(['user_id' => $user->id, 'deleted_at' => null])->all();
        foreach ($childs as $child) {
            // Пока сделали РЕБЕНОК но можно быстро поправить на сын/дочь
            if ($child->gender) {
                $list .= 'Ребёнок: ';
            } else {
                $list .= 'Ребёнок: ';
            }
            $list .= $child->fio . ' дата рождения ' . Yii::$app->formatter->asDate($child->date) . "</w:t><w:br/><w:t>";
        }
        return $list;
    }

    // Фраза для ДЗО, явлеяется или нет работником
    public function isDZO()
    {
        $user = User::findOne($this->created_by);
        $text = '';

        // Супруг(а)
        $spouse = Spouse::find()->where(['user_id' => $user->id])->one();
        if ($spouse) {
            if ($user->gender) {
                $text = 'Супруга ';
            } else {
                $text = 'Супруг ';
            }
            if ($spouse->is_rtk) {
                $text .= 'является ';
            } else {
                $text .= 'не является ';
            }
            $text .= 'работником Общества или ДЗО';
        }
        return $text;
    }

    // Среднемесячный доход на 1 члена семьи
    public function getMoneyMonthFamily()
    {
        $cnt = 1; // Сам сотрудник
        $spouseCnt = Spouse::find()->where(['user_id' => $this->created_by])->count();
        $childCnt = Child::find()->where(['user_id' => $this->created_by, 'deleted_at' => null])->count();
        return ($this->money_summa_year - $this->money_nalog_year) / ($cnt + $spouseCnt + $childCnt) / 12;
    }


    // Ипотека на ск-ко лет
    public function getIpotekaYearCount()
    {
        if (isset($this->ipoteka_start_date) && isset($this->ipoteka_last_date)) {
            return intval(($this->ipoteka_last_date - $this->ipoteka_start_date) / (60 * 60 * 24 * 365));

        } else {
            return false;
        }
    }

    public function getCompanyYear()
    {
        return (integer)Yii::$app->formatter->asDate($this->created_at, 'php:Y');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getMonthlyPerMemberIncome()
    {
        return ($this->money_summa_year - $this->money_nalog_year) / $this->user->familyMembersCount / 12;
    }

    public function getCorpNorm()
    {
        $familyMembersCount = $this->user->familyMembersCount;
        $corpNorm = CorpNorm::findOne(['number' => $familyMembersCount]);
        if ($corpNorm) {
            $corpNormArea = $corpNorm->area;
        } else {
            $corpNormArea = $familyMembersCount * 20;
        }
        return $corpNormArea;
    }


    // *** Компенсация процентов ***

    // Период оказания МП
    public function getPcPeriod()
    {
        $year = $this->companyYear;
        return "c 01.01.$year по 31.12.$year";
    }

    // Срок оказания МП
    public function getPcTerm()
    {
        $ipotekaLastDateYear = (integer)Yii::$app->formatter->asDate($this->ipoteka_last_date, 'php:Y');
        $ipotekaRes = $ipotekaLastDateYear - $this->companyYear;
        if ($ipotekaRes < 0) {
            $ipotekaRes = 0;
        }

        $userRetirementYear = (integer)Yii::$app->formatter->asDate($this->user->retirementDate, 'php:Y');
        $retRes = $userRetirementYear - $this->companyYear;

        return min(10, $ipotekaRes, $retRes);

    }

    // Ставка компенсации %%
    public function getPcRate()
    {
        // Ежемесячный доход на члета семьи
        $monthlyPerMemberIncome = $this->getMonthlyPerMemberIncome();
        $aidStandart = AidStandards::find()
            ->where(['<=', 'income_bottom', $monthlyPerMemberIncome])
            ->andWhere(['>=', 'income_top', $monthlyPerMemberIncome])
            ->one();

        $lastCompanyDate = mktime(0, 0, 0, 12, 31, $this->companyYear - 1);
        // Считаем исходя из 365 дней в году
        $age = ($lastCompanyDate - $this->user->birth_date) / 60 / 60 / 24 / 365;

        if ($age < 36) {
            return $aidStandart->skp_young;
        } else {
            return $aidStandart->skp;
        }
    }

    //  Максимальная сумма компенсации %% в целом по ДС
    public function getPcMaxVal()
    {
        return 1000000;
    }

    // Максимальная сумма компенсации %% в год
    public function getPcMaxPerYear()
    {
        // Сумма уплаченных процентов (с января по ноябрь включительно)
        // Поле не нашел, необходимо уточнить у Лады
        $paidPersents = 50000;

        // Вынести расчет коэффициента в отдельную функцию
        $percentCoefficient = $this->corpNorm / ($this->jp_new_area - ($this->ipoteka_user / $this->jp_cost * $this->jp_new_area));
        if ($percentCoefficient > 1) {
            $percentCoefficient = 1;
        }

        if ($this->ipoteka_percent > 0) {
            $res = $paidPersents * ($this->pcRate / $this->ipoteka_percent) * $percentCoefficient;
        } else {
            $res = 0;
        }

        return round($res, -3);

    }
    // *** *** *** *** *** ***


    // *** Займ ***

    // Срок оказания МП
    public function getLoanPeriod()
    {
        $userRetirementYear = (integer)Yii::$app->formatter->asDate($this->user->retirementDate, 'php:Y');
        $retRes = $userRetirementYear - $this->companyYear;

        // Ежемесячный доход на члета семьи
        $monthlyPerMemberIncome = $this->getMonthlyPerMemberIncome();
        $aidStandart = AidStandards::find()
            ->where(['<=', 'income_bottom', $monthlyPerMemberIncome])
            ->andWhere(['>=', 'income_top', $monthlyPerMemberIncome])
            ->one();

        return min($retRes, $aidStandart->compensation_years_zaim);
    }

    // Максимальный размер займа
    public function getLoanMaxVal()
    {
        $familyMembersCount = $this->user->familyMembersCount;
        // А
        $rf = $this->user->rf;
        // Если по какой-то причине не нашли запись из справичника филиалов, то используем "дефолтные" 1000000
        // TODO: доработать логику сопоставления пользователей и филиалов для 100% сопоставления  пользователь-филиал
        if ($rf) {
            $loanLimit = $rf->loan_max;
        } else {
            $loanLimit = 1000000;
        }

        // Б
        $monthlyPerMemberIncome = $this->getMonthlyPerMemberIncome();
        $jkMin = Min::findOne(['id' => $this->district_id]);
        if (!$jkMin) {
            return null;
        }

        $maxLoanByIncome = ($monthlyPerMemberIncome - $jkMin->min) * $familyMembersCount * $this->loanPeriod * 12;
        if ($maxLoanByIncome < 0) {
            $maxLoanByIncome = 0;
        }

        // В
        //        $corpNorm = CorpNorm::findOne(['number' => $familyMembersCount]);
        //        if ($corpNorm) {
        //            $corpNormArea = $corpNorm->area;
        //        } else {
        //            $corpNormArea = $familyMembersCount * 20;
        //        }

        //        $loanCoefficient = $corpNormArea / ($this->jp_new_area - $this->ipoteka_user * $this->jp_new_area / $this->jp_cost);
        $loanCoefficient = $this->corpNorm / ($this->jp_new_area - $this->ipoteka_user * $this->jp_new_area / $this->jp_cost);
        if ($loanCoefficient > 1) {
            $loanCoefficient = 1;
        }
        //$maxLoanBySize = min($this->ipoteka_size, $this->jp_cost * $loanCoefficient);
        // В займе под "ПОТРЕБНОСТЬЮ" подразумечается не "Размер ипотеки, руб", а "Займ, руб"
        $maxLoanBySize = min($this->zaim_sum, $this->jp_cost * $loanCoefficient);

        return round(min($loanLimit, $maxLoanByIncome, $maxLoanBySize), -3);
        //return round(min($maxLoanByIncome, $maxLoanBySize), -3);
    }


    /**
     * Устанавливаем новый статус для заявки
     * @param $newStatusCode код нового статуса
     */
    public function setNewStatus($newStatusCode){

        // Сотрудник, создавший заявку
        $user = User::findOne($this->created_by);

        // Текущий согласующий руководитель
        $agreement = Agreement::find()->where(['order_id' => $this->id, 'approval_at' => null])->one();
        $manager = User::findOne($agreement->user_id);

        switch ($newStatusCode) {
             // Согласование руководителями
            case 'MANAGER_WAIT':
                // Письмо сотруднику
                Yii::$app->mailer->compose(
                    '@app/modules/jk/mails/manager/manager_wait_user',
                    [
                        'user' => $user,
                        'order' => $this,
                        'manager'=>$manager
                    ]
                )
                    ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                    ->setBcc(Yii::$app->params['supportEmail'])
                    ->setTo($user->email)
                    ->setSubject($this->getEmailSubject("Согласование руководителями"))
                    ->send();
                break;

        }
    }
}