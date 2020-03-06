<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%jk_zaim}}`.
 */
class m000001_000002_create_jk_zaim_table extends Migration
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

        $this->createTable('{{%jk_zaim}}', [
            'id' => Schema::TYPE_PK,

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'date_birth' => $this->integer()->notNull(),
            'gender' => $this->boolean()->notNull(),
            'experience' => $this->integer()->notNull(),

            'family_count'=> $this->integer()->notNull(),
            'family_income'=> $this->double()->notNull(),

            'area_total'=> $this->double()->notNull(),
            'area_buy'=> $this->double()->notNull(),

            'cost_total'=> $this->double()->notNull(),
            'min_id'=> $this->integer()->notNull(),

            'compensation_count'=> $this->integer()->notNull(),
            'compensation_years'=> $this->integer()->notNull(),

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_zaim}}');
    }
}