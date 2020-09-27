<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kr_student}}`.
 */
class m200919_214529_create_kr_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->createTable('{{%kr_student}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'user_id' => $this->integer()->notNull(),
            'block_id' => $this->integer()->notNull(),
            'total'=>$this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'weight' => $this->integer()->notNull(),
        ]);
        $this->execute(file_get_contents(__DIR__ . '/../sql/kr_student.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kr_student}}');
    }
}