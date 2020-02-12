<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m000000_000001_create_user_table extends Migration
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
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'birth_date' => $this->integer(),
            'work_date'=> $this->integer(),
            'gender'=>$this->boolean(),
            'phone_mobile'=>$this->string(20),
            'phone_work'=>$this->string(20),

            'photo'=>$this->string(),
            'fio'=> $this->string(),

            'position'=> $this->string(),
            'department'=> $this->string(),
            'tab_number'=> $this->string(),
            'telephone_number'=> $this->string(),

            'passport_seria'=> $this->integer(),
            'passport_number'=> $this->integer(),
            'passport_date'=> $this->integer(),
            'passport_scan1'=> $this->string(),
            'passport_scan2'=> $this->string(),

            'snils_number'=>$this->string(),
            'snils_scan'=>$this->string(),

            'address'=>$this->string()


        ], $tableOptions);

        $this->createIndex('idx-user-username', '{{%user}}', 'username');
        $this->createIndex('idx-user-email', '{{%user}}', 'email');
        $this->createIndex('idx-user-status', '{{%user}}', 'status');

        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

    public function addData()
    {
        return "INSERT INTO {{%user}} (`id`,`username`,`auth_key`,`password_hash`,`email`,`status`,`created_at`,`updated_at`,`fio`,`photo`,`position`,`department`, `gender`,`birth_date`,`work_date`,`phone_work`,`address`)
        VALUES 
        (1,'obedkinav@ya.ru', 'a7wRnPzutnPTQUd80EnGuJH3L4PFdfUc', '$2y$13\$j7aNZGyUxzCzp7pep5UwcuQ.J682wrjD5xwd6NjOGM8uYn/Oo23.S', 'obedkinav@ya.ru',	1,	1579187759,	1579187759,'Объедкин Алексей Валерьевич','1.jpg','Главный специалист','Отдел эксплутации',1,573436800,1525132800, '8 (495) 855-44-18','108811, Российская Федерация, г. Москва, км Киевское шоссе 22-й (п Московский), д. 6, строение 1'),
        (2,'Yuliya_Shilkina@center.rt.ru ', 'a7wRnPzutnPTQUd80EnGuJH3L3PFdfUc', '$2y$13\$j7aNZGyUxzCzp8pep5UwcuQ.J682wrjD5xwd6NjOGM8uYn/Oo23.S', 'shilkina@rt.ru',	1,	1579187759,	1579187759,'Шилкина Юлия Алексеевна','2.jpg','Главный специалист','Отдел тестирования',0,573436800,1525132800, '8 (495) 855-44-18','170100, Российская Федерация, Тверская обл., г. Тверь, ул. Симеоновская, д. 28'),
        (3,'ekaterina.zinchuk@rt.ru ', 'a6wRnPzutnPTQUd80EnGuJH3L3PFdfUc', '$3y$13\$j7aNZGyUxzCzp8pep5UwcuQ.J682wrjD5xwd6NjOGM8uYn/Oo23.S', 'zinchuk@rt.ru',	1,	1579187759,	1579187759,'Зинчук Екатерина Алексеевна','3.jpg','Главный специалист','Отдел тестирования',0,573436800,1525132800, '8 (495) 855-44-18','392002, Российская Федерация, Тамбовская обл., г. Тамбов, ул. Советская, д. 36')";


    }
}