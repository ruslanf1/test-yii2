<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%token}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230118_164223_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(),
            'access_token' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-token-user_id}}',
            '{{%token}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-token-user_id}}',
            '{{%token}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-token-user_id}}',
            '{{%token}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-token-user_id}}',
            '{{%token}}'
        );

        $this->dropTable('{{%token}}');
    }
}
