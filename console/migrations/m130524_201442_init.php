<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'key_login' => $this->string()->notNull()->unique()->comment('Идентификационный номер'),
            'login' => $this->string()->notNull()->unique()->comment('Логин'),
            'email' => $this->string()->notNull()->unique()->comment('Электронная почта (необходима для восстановления'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),

            #'last_name' => $this->string()->notNull()->comment('Фамилия'), todo вынести в отдельную таблицу
            #'first_name' => $this->string()->notNull()->comment('Имя'), todo вынести в отдельную таблицу
            #'middle_name' => $this->string()->notNull()->comment('Отчество'), todo вынести в отдельную таблицу
            #'year_birth' => $this->integer()->notNull()->comment('Год рождения'), todo вынести в отдельную таблицу
            #'training_id' => $this->integer()->notNull()->comment('ID обучающей программы '), todo вынести в отдельную таблицу
            #'organization_id' => $this->integer()->notNull()->comment('ID организации'), todo вынести в отдельную таблицу
            #'status_change_reason' => $this->smallInteger()->notNull()->comment('Причина изменения статуса ????'), todo вынести в отдельную таблицу
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
