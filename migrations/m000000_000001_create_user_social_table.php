<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%user_social}}`.
 */
class m000000_000001_create_user_social_table extends Migration
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

        $this->createTable('{{%user_social}}', [
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
        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_social}}');
    }

    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%user_social}} (`created_at`,`created_by`,`title`,`description`)
        VALUES
        ($now,1,'Нет','Не относиться к социальной группе сотрудников'),
        ($now,1,'Малоимущие','Сотрудники со среднедушевым доходом в семье ниже прожиточного минимума, установленного в соответствующем субъекте РФ'),
        ($now,1,'Родители-одиночки','Сотрудники, в одиночку воспитывающие одного и более ребенка в возрасте до 18 лет (в случае обучения ребенка в высшем учебном заведении - до 23 лет)'),
        ($now,1,'Многодетные','Сотрудники, имеющие 3 и более детей в возрасте до 18 лет (в случае обучения ребенка в высшем учебном заведении - до 23 лет) в одной семье.'),
        ($now,1,'Иные сотрудники','Относятся к социальной группе по решению жилищной комиссии и/или директора филиала')";

    }
}