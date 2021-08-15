<?php

use yii\db\Migration;

class m210815_110658_create_theme_training_program_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%theme_training_program}}', [
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
        $this->dropTable('{{%theme_training_program}}');
    }
}
