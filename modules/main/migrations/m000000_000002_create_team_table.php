<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%team}}`.
 */
class m000000_000002_create_team_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%team}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'name' => $this->string()->notNull(),
                'full_name' => $this->string()->notNull(),
                'status' => $this->string()->notNull(),
                'filial' => $this->string()->notNull(),
                'position' => $this->string()->notNull(),
                'department' => $this->string()->notNull(),
                'email' => $this->string()->notNull(),
                'phone' => $this->string()->notNull(),
                'birth' => $this->integer()->notNull(),
                'address' => $this->string()->notNull(),
                'photo' => $this->string()->notNull(),
                'about' => $this->text()->notNull(),
                'weight'=>$this->integer()->notNull(),
            ],
            $tableOptions
        );
        $this->execute(file_get_contents(__DIR__ . '/../sql/team.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%team}}');
    }
}
