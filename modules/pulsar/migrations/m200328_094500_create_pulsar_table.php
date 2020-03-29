<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pulsar}}`.
 */
class m200328_094500_create_pulsar_table extends Migration
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
            '{{%pulsar}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'health_value' => $this->integer()->notNull(),
                'mood_value' => $this->integer()->notNull(),
                'job_value' => $this->integer()->notNull(),
                'health_comment' => $this->text(),
                'mood_comment' => $this->text(),
                'job_comment' => $this->text(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pulsar}}');
    }
}
