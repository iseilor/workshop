<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_child}}`.
 */
class m200405_183301_create_user_child_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_child}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer() . ' NOT NULL',
            'created_by' => $this->integer() . ' NOT NULL',
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'user_id'=> $this->integer() . ' NOT NULL',
            'fio'=> $this->string() . ' NOT NULL',
            'gender'=> $this->boolean() . ' NOT NULL',
            'date'=> $this->integer() . ' NOT NULL',

            // Пасспорт
            'passport_series'=>$this->string(),
            'passport_number'=>$this->string(),
            'passport_date'=>$this->integer(),
            'passport_department'=>$this->text(),
            'passport_code'=>$this->string(),
            'passport_address'=>$this->text(),
            'passport_file'=>$this->string(),

            // Школьник/студент
            'is_study'=>$this->boolean(),
            'file_study'=>$this->string(),
            'file_scholarship'=>$this->string(),

             // Инвалид
            'is_invalid'=>$this->boolean(),
            'file_invalid'=>$this->string(),
            'file_posobie'=>$this->string(),

             // Св-во о рождении
            'birth_series'=>$this->string()->notNull(),
            'birth_number'=>$this->string()->notNull(),
            'birth_date'=>$this->integer()->notNull(),
            'birth_department'=>$this->string()->notNull(),
            'birth_code'=>$this->string()->notNull(),
            'birth_file'=>$this->string(),

            // Проживание ребёнка
            'address_registration'=>$this->string()->notNull(),
            'address_fact'=>$this->string()->notNull(),
            'registration_file'=>$this->string(),
            'address_mother_file'=>$this->string(),
            'address_father_file'=>$this->string(),
            'ejd_file'=>$this->string(),

            // Обработка персональных данных
            'file_personal'=>$this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_child}}');
    }
}