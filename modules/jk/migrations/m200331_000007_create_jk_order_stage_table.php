<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_order_status}}`.
 */
class m200331_000007_create_jk_order_stage_table extends Migration
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
            '{{%jk_order_stage}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),
                'order_id' => $this->integer()->notNull(),
                'status_id' => $this->integer()->notNull(),

                'comment' => $this->text()->notNull(),
                'comment2' => $this->text(), // В частности у куратора 2 поля с комментариями

                // Чтобы не приумножать сущности сделаем универсальные 5 полей
                'field1' => $this->string(),
                'field2' => $this->string(),
                'field3' => $this->string(),
                'field4' => $this->string(),
                'field5' => $this->string(),
            ],
            $tableOptions
        );
        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_order_stage.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order_stage}}');
    }
}