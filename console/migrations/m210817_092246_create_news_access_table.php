<?php

use yii\db\Migration;

class m210817_092246_create_news_access_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%news_access}}', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer()->notNull(),
            'auth_item_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addCommentOnTable('news_access','Права доступа к новостям');

        // creates index for column ``
        $this->createIndex(
            'idx-news_access-user_id',
            'news_access',
            'news_id'
        );
        // add foreign key for table ``
        $this->addForeignKey(
            'fk-news_access-user_id',
            'news_access',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );

        // creates index for column ``
        $this->createIndex(
            'idx-news_access-auth_item_id',
            'news_access',
            'auth_item_id'
        );
        // add foreign key for table ``
        $this->addForeignKey(
            'fk-news_access-auth_item_id',
            'news_access',
            'auth_item_id',
            'auth_item',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%news_access}}');
    }
}
