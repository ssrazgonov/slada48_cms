<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cake_fill}}`.
 */
class m190619_182738_create_cake_fill_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cake_fill}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(255),
            'title' => $this->string(255),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cake_fill}}');
    }
}
