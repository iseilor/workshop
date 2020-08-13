<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_spouse}}`.
 */
class m200813_133218_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->addColumn('{{%user}}', 'ejd_file', $this->string(256));
        $this->addColumn('{{%user}}', 'is_temporary_registered', $this->boolean());
        $this->addColumn('{{%user}}', 'temporary_registration_file', $this->string(256));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'ejd_file');
        $this->dropColumn('{{%user}}', 'is_temporary_registered');
        $this->dropColumn('{{%user}}', 'temporary_registration_file');
    }
}