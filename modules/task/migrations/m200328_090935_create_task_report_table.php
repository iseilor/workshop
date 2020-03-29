<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_report}}`.
 */
class m200328_090935_create_task_report_table extends Migration
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
            '{{%task_report}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'project_id' => $this->string()->notNull(),
                'comment' => $this->text()->notNull()
            ],
            $tableOptions
        );

        //$this->execute(file_get_contents(__DIR__ . '/../sql/news.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_report}}');
    }
}
