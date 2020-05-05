<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_order_stop}}`.
 */
class m200412_084008_create_jk_order_stop_table extends Migration
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
        $this->createTable('{{%jk_order_stop}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'order_id' => $this->integer()->notNull(),
            'stop_id' => $this->integer()->notNull(),
            'comment' => $this->text()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order_stop}}');
    }
}