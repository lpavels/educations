<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_item}}`.
 */
class m190124_110198_create_auth_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название роли'),
            'description' => $this->string()->notNull()->comment('Описание роли'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('Статус роли (0-неактивна/1-активна)'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
        $this->addCommentOnTable('auth_item','Роли пользователей');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_item}}');
    }
}
