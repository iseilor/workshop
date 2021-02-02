<?php

use yii\db\Migration;

/**
 * Class m200731_075423_create_jk_rf_table
 */
class m200731_075423_create_jk_rf_table extends Migration
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
            '{{%jk_rf}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'title' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
                'user_id' => $this->integer()->notNull(),
                'email'=>$this->string()->notNull(),
                'phone'=>$this->string()->notNull(),
                'address'=>$this->string()->notNull(),
                'coefficient'=>$this->double()->notNull(),
                'percent_max'=>$this->double()->notNull(),
                'loan_max'=>$this->double()->notNull(),

                'header'=>$this->text()->notNull() // На имя кого пишется заявление
            ],
            $tableOptions
        );

        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_rf.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_rf}}');
    }
}