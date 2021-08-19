<?php

use yii\db\Migration;

class m210817_092244_create_theme_training_program_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%theme_training_program}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Название темы обучения'),
            'created_at' => $this->timestamp()->notNull(),
        ]);
        $this->addCommentOnTable('theme_training_program','Темы обучающих программ');
    }

    public function safeDown()
    {
        $this->dropTable('{{%theme_training_program}}');
    }
}
