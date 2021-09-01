<?php

use yii\db\Migration;

class m210817_092243_create_news_category_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%news_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addCommentOnTable('news_category','Категории новостей');
    }

    public function safeDown()
    {
        $this->dropTable('{{%news_categogy}}');
    }
}
