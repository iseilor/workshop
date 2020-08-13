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
        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_aid_standards}}');
    }

    public function addData()
    {
        return "INSERT INTO {{%jk_aid_standards}} (`created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `income_bottom`, `income_top`, `compensation_years_zaim`, `skp`, `skp_young`, `compensation_years_percent`)
        VALUES 
            (1596781650, 1, null, null, null, null, 0, 15000, 10, 10, 12, 10),
            (1596781679, 1, null, null, null, null, 15001, 25000, 10, 8, 10, 10),
            (1596781706, 1, null, null, null, null, 25001, 35000, 8, 6, 8, 10),
            (1596781736, 1, null, null, null, null, 35000, 10000000, 7, 4, 6, 10)
        ";
    }
}
