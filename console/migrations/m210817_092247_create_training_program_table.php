<?php

use yii\db\Migration;

class m210817_092247_create_training_program_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%training_program}}', [
            'id' => $this->primaryKey(),
            'theme_training_program_id' => $this->integer()->notNull()->comment('ID темы обучающей программы'),
            'name' => $this->string()->notNull()->comment('Название обучающей программы'),
            'created_at' => $this->timestamp()->notNull(),
        ]);
        $this->addCommentOnTable('training_program','Обучающие программы');

        // creates index for column ``
        $this->createIndex(
            'idx-training_program-user_id',
            'training_program',
            'theme_training_program_id'
        );

        // add foreign key for table ``
        $this->addForeignKey(
            'fk-training_program-user_id',
            'training_program',
            'theme_training_program_id',
            'theme_training_program',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%training_program}}');
    }
}
