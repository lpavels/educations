<?php

use yii\db\Migration;

class m210817_092242_create_admins_log_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%admins_log}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'table' => $this->string()->notNull()->comment('Название таблицы'),
            'primary_key' => $this->integer()->notNull()->comment('ID в таблице'),
            'comment' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'created_ip' => $this->string(15)->notNull(),
        ]);
        $this->addCommentOnTable('admins_log','Лог действий администраторов');

        // creates index for column `user_id`
        $this->createIndex(
            'idx-admins_log-user_id',
            'admins_log',
            'user_id'
        );

        // add foreign key for table `admins_log`
        $this->addForeignKey(
            'fk-admins_log-user_id',
            'admins_log',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%admin_log}}');
    }
}
