<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_min}}`.
 */
class m200331_000004_create_jk_min_table extends Migration
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
            '{{%jk_min}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' =>  $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' =>  $this->integer(),
                'deleted_by' =>  $this->integer(),
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'description' => Schema::TYPE_TEXT . ' NOT NULL',
                'min' => Schema::TYPE_FLOAT . ' NOT NULL'
            ],
            $tableOptions
        );

        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_min.sql'));
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_min}}');
    }
}