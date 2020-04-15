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
                'is_agree_personal_data' => $this->boolean()->notNull(),      // Обработка персональных данных
                'file_agree_personal_data' => $this->string(),                // Файл оброботки персональных данных
                'is_participate' => $this->boolean(),                       // Ранее участвовали
                'is_mortgage' => $this->boolean(),                          // Оформлена ипотека
                'mortgage_file' => $this->string(),                         // Кредитный договор с акктуальным графиком платежей

                // Семья
                'social_id' => $this->integer(),                        // Социальная категория
                'resident_count' => $this->integer(),                   // Кол-во проживающих с работником
                'resident_type' => $this->integer(),                    // Категория проживающих
                'family_address' => $this->text(),                      // В настоящий семья проживает момент проживает
                'resident_own' => $this->text(),                        // Собственность места проживания
                'family_rent' => $this->text(),                         // ЖП в аренде
                'family_own' => $this->text(),                          // ЖП в собственности
                'family_deal' => $this->text(),                         // Операции с квартирами за последний 5 лет
                'file_family_big' => $this->text(),                     // Удостоверение многодетной семьи
                'file_social_protection' => $this->text(),              // Удоствоерение из соц.защиты
                'file_rent'=>$this->string(),                           // Договор аренды
                'file_social_contract'=>$this->string(),                // Договор социального найма

                // Супруга



                // Жильё
                'jp_type' => $this->integer(),            // Тип жилого помещения
                'jp_params' => $this->text(),             // Параметры жилого помещения
                'jp_date' => $this->integer(),            // Дата сдачи жилого помещения
                'jp_dist' => $this->integer(),            // Расстояние до рабочего места
                'jp_own' => $this->integer(),             // Тип собственности жилого помещения
                'jp_part' => $this->text(),                 // Доли в жилом помещении

                // Ипотека
                'ipoteka_target' => $this->integer(),     // Цель ипотечного договора
                'ipoteka_size' => $this->integer(),       // Размер ипотеки
                'ipoteka_user' => $this->integer(),       // Собственные средства
                'ipoteka_params' => $this->text(),        // Параметры ипотеки
                'ipoteka_summa' => $this->text(),         // Сумма процентов подлежащих уплате за текущий год

                'ipoteka_file_dogovor' => $this->string(),          // Договор ипотеки
                'ipoteka_file_grafic_first' => $this->string(),     // Первоначальный График платежей
                'ipoteka_file_grafic_now' => $this->string(),       // Акктуальный график платежей
                'ipoteka_file_refenance' => $this->string(),        // Договор рефинансирования ипотеки
                'ipoteka_file_spravka' => $this->string(),          // Справка из банка об актуальной ставке договора рефинансирования
                'ipoteka_file_bank_approval' => $this->string(),    // Одобрение из банка


                // Финансы
                'money_oklad' => $this->double(),               // Оклад
                'money_summa_year' => $this->double(),          // Общая сумма дохода за 1 год
                'money_nalog_year' => $this->double(),          // Общая сумма удержаннаго налога за 1 год
                'money_month_pay' => $this->double(),           // Среднемесячные платежи
                'money_my_pay' => $this->double(),              // Мои среднемесячные платежи

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