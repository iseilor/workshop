<?php

use yii\db\Migration;

/**
 * Class m200824_094353_update_user_child_table
 */
class m200824_094353_update_user_child_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $sql = "ALTER TABLE {{%user_child}} ALTER COLUMN gender SET DEFAULT 1;
                ALTER TABLE {{%user_child}} ALTER COLUMN address_fact SET DEFAULT '';
                ALTER TABLE {{%user_child}} ALTER COLUMN birth_code SET DEFAULT '';";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "ALTER TABLE {{%user_child}} ALTER COLUMN gender DROP DEFAULT;
                ALTER TABLE {{%user_child}} ALTER COLUMN address_fact DROP DEFAULT;
                ALTER TABLE {{%user_child}} ALTER COLUMN birth_code DROP DEFAULT;";
        $this->execute($sql);
    }
}
