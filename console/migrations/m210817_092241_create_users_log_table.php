<?php

use yii\db\Migration;


class m210817_092241_create_users_log_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%users_log}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'user' => $this->integer()->notNull(),
            'table' => $this->string()->notNull(),
            'primary_key' => $this->integer()->notNull(),
            'comment' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'created_ip' => $this->string(15)->notNull(),
        ]);
        $this->addCommentOnTable('users_log','Лог действий пользователя');

        // creates index for column `user_id`
        $this->createIndex(
            'idx-users_log-user_id',
            'users_log',
            'user_id'
        );

        // add foreign key for table `admins_log`
        $this->addForeignKey(
            'fk-users_log-user_id',
            'users_log',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_log}}');
    }
}
