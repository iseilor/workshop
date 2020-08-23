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
            'auth_key' => $this->string(),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'birth_date' => $this->integer(),
            'work_date' => $this->integer(),

            'phone_mobile' => $this->string(20),
            'phone_work' => $this->string(20),
            'work_is_young' => $this->boolean(),          // Молодой сотрудник
            'work_is_transferred' => $this->boolean(),    // Переведённый сотрудник сотрудник
            'work_transferred_file' => $this->string(),   // Заявление о переводе

            'photo' => $this->string(),
            'gender' => $this->boolean()->notNull(),

            // ФИО
            'fio' => $this->string(),                   // ФИО: Иванов Иван Иванович
            'fio_shot' => $this->string(),              // Фамилия И.О. Иванов И.И.
            'initials' => $this->string(),              // Инициалы из AD
            'surname' => $this->string()->notNull(),    // Фамилия
            'name' => $this->string()->notNull(),       // Имя
            'patronymic' => $this->string()->notNull(), // Отчетство

            // Работа
            'position' => $this->string(),
            'work_department' => $this->text(),         // Подразделение
            'work_department_full' => $this->text(),    // Полный путь подразделения
            'work_phone' => $this->string(),            // Рабочий телефон
            'department_id' => $this->integer(),        // ID подразделения
            'manager_id' => $this->integer(),           // Руководитель из AD

            'tab_number' => $this->string(),
            'work_address' => $this->string(),

            // PASSPORT
            'passport_series' => $this->integer(),
            'passport_number' => $this->integer(),
            'passport_date' => $this->integer(),
            'passport_code' => $this->string(),
            'passport_department' => $this->string(),
            'passport_registration' => $this->string(),
            'passport_file' => $this->string(),
            'address_fact' => $this->string(),

            'ejd_file' => $this->string(),                       // ЕЖД файл
            'is_temporary_registered' => $this->boolean(),       // Временная регистрация
            'temporary_registration_file' => $this->string(),    // Файл временной регистрации

            // SNILS
            'snils_number' => $this->string(),
            'snils_date' => $this->integer(),
            'snils_file' => $this->string(),

            'role_id' => $this->integer()->notNull(),
            'auth_at' => $this->integer(), // Дата последней авторизации
            'filial_id'=>$this->integer() // Филиал

        ], $tableOptions);

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