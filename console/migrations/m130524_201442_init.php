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
            'last_name' => $this->string()->notNull()->comment('Фамилия'),
            'first_name' => $this->string()->notNull()->comment('Имя'),
            'middle_name' => $this->string()->notNull()->comment('Отчество'),
            'year_birth' => $this->integer()->notNull()->comment('Год рождения'),
            'training_id' => $this->integer()->notNull()->comment('ID обучающей программы'),
            'organization_id' => $this->integer()->notNull()->comment('ID организации'),
            'email' => $this->string()->notNull()->unique()->comment('Электронная почта для восстановления логина'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'status_change_reason' => $this->smallInteger()->notNull()->comment('Причина изменения статуса'),

            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
