<?php

use yii\db\Migration;

class m210815_110634_create_news_categogy_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%news_categogy}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'created_user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_user_id' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%news_categogy}}');
    }
}
