<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_task_status}}`.
 */
class m200625_152424_create_project_task_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_task_status}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull(),
            'color'=>$this->string()->notNull(),
            'progress'=>$this->integer(),
        ]);

        $this->execute(file_get_contents(__DIR__ . '/../sql/task-status.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_task_status}}');
    }
}
