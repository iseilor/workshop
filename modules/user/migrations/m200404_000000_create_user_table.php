<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200404_000000_create_user_table extends Migration
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

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'birth_date' => $this->integer(),
            'work_date'=> $this->integer(),

            'phone_mobile'=>$this->string(20),
            'phone_work'=>$this->string(20),
            'work_is_young'=>$this->boolean(),          // Молодой сотрудник
            'work_is_transferred'=>$this->boolean(),    // Переведённый сотрудник сотрудник

            'photo'=>$this->string(),
            'fio'=> $this->string()->notNull(),
            'gender'=>$this->boolean()->notNull(),

            'surname'=>$this->string()->notNull(),
            'name'=>$this->string()->notNull(),
            'patronymic'=>$this->string()->notNull(),
            'auth_at'=>$this->integer(), // Авторизация последний раз

            // Работа
            'position'=> $this->string(),
            'work_department'=> $this->string(),        // Подразделение
            'work_department_full'=> $this->string(),   // Полный путь подразделения
            'work_phone'=> $this->string(),             // Рабочий телефон
            'department_id'=>$this->integer(),          // ID подразделения
            'manager_id'=>$this->integer(),             // Руководитель из AD

            'tab_number'=> $this->string(),
            'work_address'=>$this->string(),

            // PASSPORT
            'passport_series'=> $this->integer(),
            'passport_number'=> $this->integer(),
            'passport_date'=> $this->integer(),
            'passport_code'=> $this->string(),
            'passport_department'=>$this->string(),
            'passport_registration'=>$this->string(),
            'passport_file'=> $this->string(),
            'address_fact'=> $this->string(),

            // SNILS
            'snils_number'=>$this->string(),
            'snils_date'=>$this->integer(),
            'snils_file'=>$this->string(),

            'role_id'=>$this->integer()->notNull()

        ], $tableOptions);

        $this->createIndex('idx-user-username', '{{%user}}', 'username');
        $this->createIndex('idx-user-email', '{{%user}}', 'email');
        $this->createIndex('idx-user-status', '{{%user}}', 'status');

        $this->execute(file_get_contents(__DIR__ . '/../sql/user-local.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

}