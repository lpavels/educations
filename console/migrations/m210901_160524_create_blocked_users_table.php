<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blocked_users}}`.
 */
class m210901_160524_create_blocked_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blocked_users}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Кто за-/разблокировал'),
            'user' => $this->integer()->notNull()->comment('Кто за-/разблокирован'),
            'reason' => $this->string()->notNull()->comment('Причина раз-/блокировки'),
            'comment' => $this->string()->notNull()->comment('Комментарий для администрации'),
            'status' => $this->boolean()->notNull()->comment('0 - разблокирован, 1 - заблокирован'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addCommentOnTable('blocked_users','Заблокированные и разблокированные пользовали с причиной');

        // creates index for column `user_id`
        $this->createIndex(
            'idx-blocked_users-user_id',
            'blocked_users',
            'user_id'
        );

        // add foreign key for table `admins_log`
        $this->addForeignKey(
            'fk-blocked_users-user_id',
            'blocked_users',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-blocked_users-user',
            'blocked_users',
            'user'
        );

        // add foreign key for table `admins_log`
        $this->addForeignKey(
            'fk-blocked_users-user',
            'blocked_users',
            'user',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blocked_users}}');

        // drops index for column ``
        $this->dropIndex(
            'idx-blocked_users-user_id',
            'blocked_users'
        );

        // drops foreign key for table ``
        $this->dropForeignKey(
            'fk-blocked_users-user_id',
            'blocked_users'
        );

        // drops index for column ``
        $this->dropIndex(
            'idx-blocked_users-user',
            'blocked_users'
        );

        // drops foreign key for table ``
        $this->dropForeignKey(
            'fk-blocked_users-user',
            'blocked_users'
        );
    }
}
