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

            'user_id'=> $this->integer() . ' NOT NULL', // Сотрудник
            'fio'=> $this->string() . ' NOT NULL',      // ФИО супруги
            'gender'=> $this->boolean() . ' NOT NULL',  // Пол
            'date'=> $this->integer() . ' NOT NULL',    // Дата рождения

            'passport_series'=>$this->string(),         // Паспорт
            'passport_number'=>$this->string(),
            'passport_date'=>$this->integer(),
            'passport_department'=>$this->string(),
            'passport_code'=>$this->string(),
            'passport_file'=>$this->string(),

            'agree_personal_data' => $this->boolean(),      // Обработка персональных данных
            'agree_personal_data_file' => $this->string(),

            'edj'=>$this->string(),             // Единый жилищный документ
            'edj_file'=>$this->string(),

            'is_work' => $this->boolean(),           // Супруга официально работает
            'is_rtk'=>$this->boolean(),              // Работает в Обществе
            'is_do' => $this->boolean(),             // Супруга в декретном отпуске

            'marriage_file'=>$this->string(), // Свидетельство о заключении/расторжения брака / копию решения суда
            'registration_file'=>$this->string(), // Документ о временной регистрации (при наличии)

            'explanatory_note_file'=>$this->string(),       // Пояснительная записка
            'work_file'=>$this->string(),                   // Трудовая книжка
            'unemployment_file'=>$this->string(),           // Справка о безработице
            'salary_file'=>$this->string(),                 // Справка о заработной плате (о сумме получаемых пособий)

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_spouse}}');
    }
}