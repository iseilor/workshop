<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_order}}`.
 */
class m000001_000006_create_jk_order_table extends Migration
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
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER,
                'updated_by' => Schema::TYPE_INTEGER,
                'deleted_at' => Schema::TYPE_INTEGER,
                'deleted_by' => Schema::TYPE_INTEGER,


                'percent_count'=> Schema::TYPE_INTEGER,
                'percent_years'=> Schema::TYPE_INTEGER,
                'zaim_count'=> Schema::TYPE_INTEGER,
                'zaim_years'=> Schema::TYPE_INTEGER,

                'progress'=> Schema::TYPE_INTEGER,
                'status_id'=> $this->integer()->notNull(),
                'sum'=> Schema::TYPE_INTEGER,

                'is_mortgage'=>Schema::TYPE_BOOLEAN,    // Оформлена ипотека
                'mortgage_file'=>$this->string(),       // Кредитный договор с акктуальным графиком платежей

                // Семья
                'is_spouse'=>$this->integer(),          // Наличие супруга, супруги (Да, Нет, Разведён)
                'spouse_fio'=>$this->string(),          // ФИО супруги
                'spouse_is_dzo'=>$this->boolean(),      // Супруга работник общества или ДЗО
                'spouse_is_do'=>$this->boolean(),       // Супруга в ДО
                'spouse_is_work'=>$this->boolean(),     // Супруга официально работает
                'child_count'=> $this->integer(),       // Кол-во детей
                'child_count_18'=> $this->integer(),    // Кол-во до 18 лет
                'child_count_23'=> $this->integer(),    // Кол-во до 23 лет

                // Жильё
                'zaim_type'=>$this->integer(),          // Тип займа

                'is_participate'=>$this->boolean(),     // Ранее не участоваол
                'percent_sum'=>$this->text(),           // Сумма процентов
                'target_mortgage'=>$this->integer(),    // Цель ипотеки
                'property_type'=>$this->integer(),      // Тип собственности

                // Доходы
                'salary'=>$this->double(),              // Оклад
                'total_sum_income'=>$this->double(),    // Общая сумма дохода за 1 год
                'total_sum_nalog'=>$this->double(),     // Общая сумма удержаннаго налога за 1 год
                'month_pay'=>$this->double(),           // Среднемесячные платежи
                'month_my_pay'=>$this->double(),        // Мои среднемесячные платежи

            ],
            $tableOptions
        );
        $this->execute($this->addData());
    }

    // Добавление первоначальных данных
    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%jk_order}} (`created_at`,`created_by`,`progress`,`status_id`,`sum`)
        VALUES
        ($now,1,70,1,1000000),
        ($now,2,50,1,700000),
        ($now,2,20,1,400000)";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order}}');
    }
}