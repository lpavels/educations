<?php

use yii\db\Migration;


class m210817_092240_create_personal_data_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%personal_data}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'last_name' => $this->string()->notNull()->comment('Фамилия'),
            'first_name' => $this->string()->notNull()->comment('Имя'),
            'middle_name' => $this->string()->notNull()->comment('Отчество'),
            'date_birth' => $this->integer()->notNull()->comment('Дата рождения'),
            'organization_id' => $this->integer()->notNull()->comment('id организации'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
        $this->addCommentOnTable('personal_data','Информация о пользователе');

        // creates index for column `user_id`
        $this->createIndex(
            'idx-personal_data-user_id',
            'personal_data',
            'user_id'
        );

        // add foreign key for table `personal_data`
        $this->addForeignKey(
            'fk-personal_data-user_id',
            'personal_data',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%personal_data}}');
    }
}
