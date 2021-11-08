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
            'auth_item_id' => $this->integer()->comment('id роли пользователя'),
            'key_login' => $this->string()->unique()->comment('Идентификационный номер'),
            'username' => $this->string()->notNull()->unique()->comment('Логин'),
            'email' => $this->string()->notNull()->unique()->comment('Электронная почта (необходима для восстановления)'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('Статус пользователя (активен/неактивен)'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
        ], $tableOptions);
        $this->addCommentOnTable('user','Таблица пользователей');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
