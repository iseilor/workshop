<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_aid_standards}}`.
 */
class m200813_114339_update_jk_order_table extends Migration
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

        $this->addColumn('{{%jk_order}}', 'resident_own_type', $this->integer());
        $this->addColumn('{{%jk_order}}', 'is_poor', $this->boolean());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%jk_order}}', 'resident_own_type');
        $this->dropColumn('{{%jk_order}}', 'is_poor');
    }
}
