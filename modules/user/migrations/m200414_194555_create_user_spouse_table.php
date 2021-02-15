<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_spouse}}`.
 */
class m200414_194555_create_user_spouse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_spouse}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer() . ' NOT NULL',
            'created_by' => $this->integer() . ' NOT NULL',
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            // Общие параметры
            'type'=>$this->integer()->notNull(),            // Наличие супруги

            'user_id'=> $this->integer() . ' NOT NULL',     // Сотрудник
            'fio'=> $this->string(),                        // ФИО супруги
            'gender'=> $this->boolean(),                    // Пол
            'date'=> $this->integer(),                      // Дата рождения
            'marriage_file'=>$this->string(),               // Свидетельство о заключении/расторжения брака / копию решения суда
            'agreement_ppd'=>$this->boolean(),              // Согласие на обработку персональных данных

            // Паспорт
            'passport_series'=>$this->string(),
            'passport_number'=>$this->string(),
            'passport_date'=>$this->integer(),
            'passport_department'=>$this->string(),
            'passport_code'=>$this->string(),
            'passport_registration'=>$this->text(),
            'address_fact'=>$this->text(),
            'passport_file'=>$this->string(),

            // Адрес
            'registration_file'=>$this->string(),       // Документ о временной регистрации (при наличии)
            'edj_file'=>$this->string(),                // Единый жилищный документ

            // Трудоустройство
            'is_work' => $this->boolean(),           // Супруга официально работает
            'is_rtk'=>$this->boolean(),                         // Работает в Обществе
            'is_do' => $this->boolean(),                        // Супруга в декретном отпуске
            'explanatory_note_file'=>$this->string(),           // Пояснительная записка
            'work_file'=>$this->string(),                       // Трудовая книжка
            'unemployment_file'=>$this->string(),               // Справка о безработице
            'salary_file'=>$this->string(),                     // Справка о заработной плате (о сумме получаемых пособий)
            'ndfl2_file'=>$this->string(),                      //Справка 2 НДФЛ

            // Персональные данные
            'personal_data_file' => $this->string(),

        ], $tableOptions);

        $this->execute(file_get_contents(__DIR__ . '/../sql/user_spouse.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_spouse}}');
    }
}