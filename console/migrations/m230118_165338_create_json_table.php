<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%json}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230118_165338_create_json_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%json}}', [
            'id' => $this->primaryKey(),
            'json' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-json-user_id}}',
            '{{%json}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-json-user_id}}',
            '{{%json}}',
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
            '{{%fk-json-user_id}}',
            '{{%json}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-json-user_id}}',
            '{{%json}}'
        );

        $this->dropTable('{{%json}}');
    }
}
