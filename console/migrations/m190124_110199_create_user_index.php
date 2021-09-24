<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_item}}`.
 */
class m190124_110199_create_user_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // creates index for column ``
        $this->createIndex(
            'idx-user-auth_item_id',
            'user',
            'auth_item_id'
        );

        // add foreign key for table ``
        $this->addForeignKey(
            'fk-user-auth_item_id',
            'user',
            'auth_item_id',
            'auth_item',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_item}}');
    }
}
