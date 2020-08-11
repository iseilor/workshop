<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_aid_standards}}`.
 */
class m200806_211529_create_jk_aid_standards_table extends Migration
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

        $this->createTable('{{%jk_aid_standards}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'income_bottom' => $this->double()->notNull(),
            'income_top' => $this->double()->notNull(),
            'compensation_years_zaim' => $this->integer()->notNull(),
            'skp' => $this->double()->notNull(),
            'skp_young' => $this->double()->notNull(),
            'compensation_years_percent' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_aid_standards}}');
    }
}
