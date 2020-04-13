<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_social}}`.
 */
class m200413_080819_create_jk_social_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%jk_social}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer() . ' NOT NULL',
            'created_by' => $this->integer() . ' NOT NULL',
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
            'title'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull()
        ], $tableOptions);
        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_social.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_social}}');
    }
}
