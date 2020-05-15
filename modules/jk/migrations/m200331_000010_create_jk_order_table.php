<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_order}}`.
 */
class m200331_000010_create_jk_order_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions
                = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(
            '{{%jk_order}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'percent_count' => $this->integer(),
                'percent_years' => $this->integer(),
                'zaim_count' => $this->integer(),
                'zaim_years' => $this->integer(),

                'progress' => $this->integer(),
                'status_id' => $this->integer()->notNull(),
                'sum' => $this->integer(),

                // Параметры
                'is_agree_personal_data' => $this->boolean()->notNull(),                 // Обработка персональных данных
                'file_agree_personal_data' => $this->string(),                           // Файл оброботки персональных данных
                'is_participate' => $this->boolean(),                                    // Ранее участвовали
                'type' => $this->integer()->notNull(),                                   // Тип заявки

                // Семья
                'social_id' => $this->integer(),                // Социальная категория
                'resident_count' => $this->integer(),                // Кол-во проживающих с работником
                'resident_type' => $this->integer(),                // Категория проживающих
                'family_address' => $this->text(),                 // В настоящий семья проживает момент проживает
                'resident_own' => $this->text(),                 // Собственность места проживания
                'family_rent' => $this->text(),                // ЖП в аренде
                'family_own' => $this->text(),                // ЖП в собственности
                'family_deal' => $this->text(),                // Операции с квартирами за последний 5 лет
                'file_family_big' => $this->text(),                // Удостоверение многодетной семьи
                'file_social_protection' => $this->text(),                // Удоствоерение из соц.защиты
                'file_rent' => $this->string(),                // Договор аренды
                'file_social_contract' => $this->string(),                // Договор социального найма

                // Супруга

                // Жильё. Поля
                'jp_type' => $this->integer(),              // Тип жилого помещения
                'jp_address' => $this->string(),            // Адрес
                'jp_room_count'=>$this->integer(),          // Кол-во комнат
                'jp_area'=>$this->double(),                 // Площадь
                'jp_cost'=>$this->double(),                 // Полная стоимость
                'jp_dogovor_date'=>$this->integer(),        // Дата договора
                'jp_registration_date'=>$this->integer(),   // Дата регистрации
                'jp_date' => $this->integer(),              // Дата сдачи жилого помещения
                'jp_dist' => $this->integer(),              // Расстояние до рабочего места
                'jp_own' => $this->integer(),               // Тип собственности жилого помещения
                'jp_part' => $this->text(),                 // Доли в жилом помещении

                // Жильё. Файлы. Ипотека
                'jp_dogovor_buy_file' => $this->text(),        // 1) Договор приобретения ЖП (ДДУ, ДС, ДКП и пр.)  (+файлы регистрации если регистрация электронная
                'jp_act_file' => $this->text(),                // 2) Акт
                'jp_egrp_file' => $this->text(),               // 3) ЕГРП (+файлы регистрации если регистрация электронная)
                'jp_own_land_file' => $this->text(),           // 4) Св-во о собственности на земельный участок (ЕГРП)
                'jp_own_house_file' => $this->text(),          // 5) Св-во о собственности на дом (ЕГРП)

                // Жильё. Файлы. Займ
                'jp_dogovor_bron_file' => $this->text(),            // 1) Договор бронирования (при наличии)
                'jp_pravo_document_file' => $this->text(),          // 2) копию правоустанавливающих документов на земельный участок;
                'jp_grad_plane_file' => $this->text(),              // 3) копию градостроительного плана земельного участка (при наличии);
                'jp_scheme_plane_org_file' => $this->text(),        // 4) копию схемы планировочной организации земельного участка с
                'jp_building_permit_file' => $this->text(),         // 5) копию разрешения на строительство дома – документ, выдаваемый федеральным органом
                'jp_project_house_file' => $this->text(),           // 6) проект дома;
                'jp_construction_estimate_file' => $this->text(),   // 7) смету строительства дома;
                'jp_time_grafic_build_file' => $this->string(),     // 8) сроки и график строительства;
                'jp_photo_file' => $this->string(),                 // 9) фотографии участка/дома;
                'jp_template_report_file' => $this->string(),            // 10) шаблон письменного отчета

                // Ипотека
                'is_mortgage' => $this->boolean(),       // Оформлена ипотека
                'ipoteka_target' => $this->integer(),    // Цель ипотечного договора
                'ipoteka_size' => $this->double(),      // Размер ипотеки
                'ipoteka_user' => $this->double(),      // Собственные средства
                'ipoteka_percent' => $this->float(),    // Процент по ипотеке
                'ipoteka_last_date' => $this->integer(), // Дата последнего платежа
                'ipoteka_grafic' => $this->text(),       // График платежей

                // Ипотека.Файлы
                'ipoteka_file_dogovor' => $this->string(),          // Договор ипотеки
                'ipoteka_file_grafic_first' => $this->string(),     // Первоначальный График платежей
                'ipoteka_file_grafic_now' => $this->string(),       // Акктуальный график платежей
                'ipoteka_file_refenance' => $this->string(),        // Договор рефинансирования ипотеки
                'ipoteka_file_spravka' => $this->string(),          // Справка из банка об актуальной ставке договора рефинансирования
                'ipoteka_file_bank_approval' => $this->string(),    // Одобрение из банка

                // Финансы
                'money_oklad' => $this->double(),           // Оклад
                'ndfl2_file' => $this->string(),            // 2 НДФЛ файл
                'is_do' => $this->boolean(),                // В Декретном отпуске
                'spravka_zp_file' => $this->string(),       // Справка о заработной плате
                'money_summa_year' => $this->double(),      // Общая сумма дохода за 1 год
                'money_nalog_year' => $this->double(),      // Общая сумма удержаннаго налога за 1 год
                'money_month_pay' => $this->double(),       // Среднемесячные платежи
                'money_user_pay' => $this->double(),        // Мои среднемесячные платежи
            ],
            $tableOptions
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order}}');
    }
}