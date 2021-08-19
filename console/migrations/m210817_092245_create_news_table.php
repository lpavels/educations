<?php

use yii\db\Migration;

class m210817_092245_create_news_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'theme_training_program_id' => $this->integer()->notNull()->comment('Тема обучающей программы (метка новости)'),
            'news_categogy_id' => $this->integer()->notNull()->comment('Категория новости (ютуб, важно, новость)'),
            'theme' => $this->string(255)->notNull()->unique()->comment('Тема новости'),
            'small_text' => $this->string(255)->notNull()->unique()->comment('Краткая новость'),
            'full_text' => $this->text()->notNull()->unique()->comment('Полная новость'),
            'sequence_number' => $this->integer()->notNull()->comment('Порядковый номер новости'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('0-не отображается, 1 - отображается'),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
        ]);
        $this->addCommentOnTable('news','Новости');

        // creates index for column `category_id`
        $this->createIndex(
            'idx-news-theme_training_program_id',
            'news',
            'theme_training_program_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-news-theme_training_program_id',
            'news',
            'theme_training_program_id',
            'theme_training_program',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-news-news_categogy_id',
            'news',
            'news_categogy_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-news-news_categogy_id',
            'news',
            'news_categogy_id',
            'news_category',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%news}}');

        // drops foreign key for table ``
        $this->dropForeignKey(
            'fk-news-news_categogy_id',
            'news'
        );

        // drops index for column ``
        $this->dropIndex(
            'idx-news-news_categogy_id',
            'news',
        );
    }
}
