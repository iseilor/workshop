<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_order}}`.
 */
class m000001_000006_create_jk_order_table extends Migration
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
            '{{%jk_order}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER,
                'updated_by' => Schema::TYPE_INTEGER,
                'deleted_at' => Schema::TYPE_INTEGER,
                'deleted_by' => Schema::TYPE_INTEGER,

                'progress'=> Schema::TYPE_INTEGER,
                'status'=> Schema::TYPE_INTEGER,
                'sum'=> Schema::TYPE_INTEGER
            ],
            $tableOptions
        );
        $this->execute($this->addData());
    }

    // Добавление первоначальных данных
    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%jk_order}} (`created_at`,`created_by`,`progress`,`status`,`sum`)
        VALUES
        ($now,1,70,1,1000000),
        ($now,2,50,2,700000),
        ($now,3,20,3,400000)";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order}}');
    }
}