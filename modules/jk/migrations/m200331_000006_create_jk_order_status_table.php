<?php


use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_order_status}}`.
 */
class m200331_000006_create_jk_order_status_table extends Migration
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

        $this->createTable(
            '{{%jk_order_status}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),
                'title' => $this->string()->notNull(),
                'title_long' => $this->string()->notNull(),
                'progress' => $this->integer(),
                'color' => $this->string(),
                'icon' => $this->string()->notNull(),
                'description' => $this->text(),
            ],
            $tableOptions
        );
        $this->execute($this->addData());
    }

    // Добавление первоначальных данных
    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%jk_order_status}} (`created_at`,`created_by`,`title`,`title_long`,`progress`,`color`,`icon`,`description`)
        VALUES
        ($now,1,'Новая','Новая заявка',5,'green','plus','Новая заявка'),
        ($now,1,'Проверка','Проверка куратором',10,'blue','tasks','Заявка находится на проверке у куратора'),
        ($now,1,'Возврат','Возврат куратором',10,'yellow','undo','Заявка возвращена куратором для исправления'),
        ($now,1,'Оклонено','Отклонено куратором',10,'red','times','Куратор отклонил заявку'),
        ($now,1,'Проверно','Проверено куратором',20,'green','check','Куратор проверил заявку'),
        ($now,1,'Согласование','Согласоване руководителем',30,'blue','tasks','На согласовании у руководителя'),
        ($now,1,'Согласовано','Согласовано руководителем',40,'green','check','Согласовано руководителем'),
        ($now,1,'Не согласовано','Не согласовано руководителем',50,'red','times','Не согласовано руководителем'),
        ($now,1,'Согласование','Согласование комиссией',70,'blue','tasks','Согласование жилищной коммиссией'),
        ($now,1,'Согласовано','Согласовано комиссией',80,'green','check','Согласовано жилищной коммиссией'),
        ($now,1,'Не согласовано','Не согласовано коммисией',80,'red','tasks','Не согласовано жилищной коммиссией'),
        ($now,1,'Отложено','Отложено на следующий год',80,'yellow','pause','Отложено жилищной коммисией на следующий год'),
        ($now,1,'Ожидание','Ожидание выплаты',90,'blue','hourglass-half','Ожидание выплаты'),
        ($now,1,'Выполнено','Заявка выполнена',100,'green','flag-checkered','Заявка успешно завершена'),
        ($now,1,'Отменено','Отмена инициатором',100,'blue','stop','Заявка отменен инициатором')";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order_status}}');
    }
}