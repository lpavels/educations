<?php

use yii\db\Migration;

class m210817_092248_create_user_training_program_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user_training_program}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'training_program_id' => $this->integer()->notNull()->comment('Обучающая программа пользователя'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addCommentOnTable('user_training_program','Обучающие программы, которые выбрал пользователь');

        # creates index for column ``
        $this->createIndex(
            'idx-user_training_program-user_id',
            'user_training_program',
            'user_id'
        );

        # creates index for column ``
        $this->createIndex(
            'idx-user_training_program-training_program_id',
            'user_training_program',
            'training_program_id'
        );

        # add foreign key for table ``
        $this->addForeignKey(
            'fk-user_training_program-user_id',
            'user_training_program',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        # add foreign key for table ``
        $this->addForeignKey(
            'fk-user_training_program-training_program_id',
            'user_training_program',
            'training_program_id',
            'training_program',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_training_program}}');
    }
}
