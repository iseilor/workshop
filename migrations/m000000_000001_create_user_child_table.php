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
            'user_id'=> $this->integer() . ' NOT NULL',
            'number'=> $this->integer() . ' NOT NULL',
            'fio'=> $this->string() . ' NOT NULL',
            'date'=> $this->integer() . ' NOT NULL'

        ], $tableOptions);

        $this->execute($this->addData());
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
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%user_child}} (`created_at`,`created_by`,`user_id`,`number`,`fio`,`date`)
        VALUES
            ($now,1,1,1,'Иванова София Алексеевна',$now),
            ($now,1,1,2,'Иванова Полина Алексеевна',$now),
            ($now,1,1,3,'Иванова Анастасия Алексеевна',$now),
            ($now,1,2,1,'Иванова София Алексеевна',$now),
            ($now,1,2,2,'Иванова Полина Алексеевна',$now),
            ($now,1,2,3,'Иванова Анастасия Алексеевна',$now)";
    }
}