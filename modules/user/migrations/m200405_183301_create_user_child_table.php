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

            'file_passport'=>$this->string(),
            'file_registration'=>$this->string(),
            'file_birth'=>$this->string(),
            'file_address'=>$this->string(),
            'file_ejd'=>$this->string(),
            'file_personal'=>$this->string(),

            'is_invalid'=>$this->boolean(),
            'file_invalid'=>$this->string(),
            'file_posobie'=>$this->string(),

            'is_study'=>$this->boolean(),
            'file_study'=>$this->string(),
            'file_scholarship'=>$this->string()
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