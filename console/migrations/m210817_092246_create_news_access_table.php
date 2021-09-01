<?php

use yii\db\Migration;

class m210817_092246_create_news_access_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%news_access}}', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer()->notNull(),
            'user_role_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addCommentOnTable('news_access','Права доступа к новостям');

        // creates index for column `user_id`
        $this->createIndex(
            'idx-news_access-user_id',
            'news_access',
            'news_id'
        );

        // add foreign key for table `admins_log`
        $this->addForeignKey(
            'fk-news_access-user_id',
            'news_access',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%news_access}}');
    }
}
