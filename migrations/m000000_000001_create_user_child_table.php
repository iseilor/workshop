<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_child}}`.
 */
class m000000_000001_create_user_child_table extends Migration
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
            'number'=> $this->integer() . ' NOT NULL',
            'fio'=> $this->string() . ' NOT NULL',
            'date'=> $this->integer() . ' NOT NULL'

        ], $tableOptions);

        //$this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_child}}');
    }

    public function addData()
    {
        return "INSERT INTO {{%user}} (`id`,`username`,`auth_key`,`password_hash`,`email`,`status`,`created_at`,`updated_at`,`fio`,`photo`,`position`,`work_department`,`work_department_full`,`work_phone`, `gender`,`birth_date`,`work_date`,`phone_work`,`work_address`,`role_id`)
        VALUES 
        (1,'obedkinav@ya.ru', 'a7wRnPzutnPTQUd80EnGuJH3L4PFdfUc', '$2y$13\$j7aNZGyUxzCzp7pep5UwcuQ.J682wrjD5xwd6NjOGM8uYn/Oo23.S', 'obedkinav@ya.ru',	1,	1579187759,	1579187759,'Объедкин Алексей Валерьевич','1.jpg','Главный специалист','Отдел эксплутации','Группировка_Центр | Блок информационных технологий | Департамент эксплуатации информационных систем и платформ | Отдел эксплуатации систем поддержки операций','+7 (495) 855-44-18, внутр. (701) 1-4418',1,573436800,1525132800, '8 (495) 855-44-18','108811, Российская Федерация, г. Москва, км Киевское шоссе 22-й (п Московский), д. 6, строение 1',2)";


    }
}