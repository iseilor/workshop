<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_stop}}`.
 */
class m200404_175000_create_jk_stop_table extends Migration
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
        $this->createTable('{{%jk_stop}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'status_id' => $this->string()->notNull(),
        ], $tableOptions);
        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_stop.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_stop}}');
    }
}