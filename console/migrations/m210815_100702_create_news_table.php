<?php

use yii\db\Migration;

class m210815_100702_create_news_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'theme_training_program_id' => $this->integer()->notNull()->comment('Тема обучающающей программы (метка новости)'),
            'news_categogy_id' => $this->integer()->notNull()->comment('Категория новости (ютуб, важно, новость)'),
            'theme' => $this->string(255)->notNull()->unique()->comment('Тема новости'),
            'small_text' => $this->string(255)->notNull()->unique()->comment('Краткая новость'),
            'full_text' => $this->text()->notNull()->unique()->comment('Полная новость'),
            'sequence_number' => $this->integer()->notNull()->comment('Порядковый номер новости'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('0-не отображается, 1 - отображается'),

            'created_user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_user_id' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
