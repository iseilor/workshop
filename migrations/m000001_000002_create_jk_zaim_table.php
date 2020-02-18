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

            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME,
            'updated_by' => Schema::TYPE_INTEGER,
            'deleted_at' => Schema::TYPE_DATETIME,
            'deleted_by' => Schema::TYPE_INTEGER,

            'date_birth' => Schema::TYPE_INTEGER . ' NOT NULL',
            'gender' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'experience' => Schema::TYPE_INTEGER . ' NOT NULL',

            'family_count'=> Schema::TYPE_INTEGER . ' NOT NULL',
            'family_income'=> Schema::TYPE_INTEGER . ' NOT NULL',

            'area_total'=> $this->double()->notNull(),
            'area_buy'=> $this->double()->notNull(),

            'cost_total'=> $this->double()->notNull(),
            'cost_user' => $this->double()->notNull(),
            'bank_credit' => $this->double(),

            'min_id'=> Schema::TYPE_INTEGER . ' NOT NULL',

            'compensation_count'=> Schema::TYPE_INTEGER . ' NOT NULL',
            'compensation_years'=> Schema::TYPE_INTEGER. ' NOT NULL'

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
